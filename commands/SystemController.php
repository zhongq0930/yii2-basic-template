<?php

namespace app\commands;

use app\helpers\ModuleHelper;
use app\modules\user\models\User;
use dektrium\user\helpers\Password;
use Yii;
use yii\base\InvalidConfigException;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

/**
 * Class SystemController
 * @package app\commands
 */
class SystemController extends Controller
{
    /**
     * @return int
     * @throws InvalidConfigException
     * @throws \yii\base\InvalidRouteException
     * @throws \yii\base\NotSupportedException
     */
    public function actionInstall()
    {
        if ($this->getIsInstalled()) {
            echo "System installed\n";

            return ExitCode::OK;
        }

        echo "Installing\n\n";

        $username = $this->prompt('Enter username', [
            'required' => true,
            'default' => 'admin',
        ]);
        $password = $this->prompt('Enter password', [
            'required' => true,
        ]);
        $email = $this->prompt('Enter email', [
            'default' => null,
        ]);

        $migrationPath = [
            '@vendor/dektrium/yii2-user/migrations',
            '@app/migrations',
        ];

        $migrationPath = ArrayHelper::merge(
            $migrationPath,
            ModuleHelper::getMigrationPaths()
        );

        /**
         * @var \yii\base\Controller $migrateController
         */
        $migrateController = Yii::createObject([
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => $migrationPath,
        ], ['migrate', $this->module]);

        $migrateController->runAction('up');

        $db = Yii::$app->getDb();

        $transaction = $db->beginTransaction();
        try {
            echo "*** insert default data\n";

            $db->createCommand()->insert('{{%user}}', [
                'username' => $username,
                'email' => $email,
                'password_hash' => Password::hash($password),
                'auth_key' => Yii::$app->security->generateRandomString(),
                'access_token' => Yii::$app->security->generateRandomString(),
                'confirmed_at' => time(),
                'created_at' => time(),
                'updated_at' => time(),
            ])->execute();

            $db->createCommand()->insert('{{%profile}}', [
                'user_id' => $db->lastInsertID,
            ])->execute();

            $transaction->commit();

            echo "install successfully\n";

            return ExitCode::OK;
        } catch (\Exception $e) {
            $transaction->rollBack();

            echo 'install fail, with message: ' . $e->getMessage() . "\n";

            return ExitCode::UNSPECIFIED_ERROR;
        }
    }

    /**
     * @throws InvalidConfigException
     * @throws \yii\base\InvalidRouteException
     */
    public function actionUpgrade()
    {
        $migrationPath = ModuleHelper::getMigrationPaths();

        /**
         * @var \yii\base\Controller $migrateController
         */
        $migrateController = Yii::createObject([
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => $migrationPath,
        ], ['migrate', $this->module]);

        $migrateController->runAction('up');
    }

    /**
     * @return bool
     * @throws \yii\base\NotSupportedException
     */
    private function getIsInstalled()
    {
        return $this->getIsDbConnectionValid()
            && $this->tableExists('{{%settings}}', false)
            && $this->dataExists();
    }

    /**
     * @return bool
     */
    private function getIsDbConnectionValid()
    {
        try {
            Yii::$app->getDb()->open();
            return true;
        } catch (Exception $e) {
            return false;
        } catch (InvalidConfigException $e) {
            return false;
        }
    }

    /**
     * @param string $table
     * @param bool|null $refresh
     * @return bool
     * @throws \yii\base\NotSupportedException
     */
    private function tableExists(string $table, bool $refresh = null): bool
    {
        $table = Yii::$app->getDb()->getSchema()->getRawTableName($table);

        return in_array($table, Yii::$app->getDb()->getSchema()->getTableNames(), true);
    }

    /**
     * @return bool
     */
    private function dataExists()
    {
        $user = User::find()->one();

        return $user !== null;
    }
}