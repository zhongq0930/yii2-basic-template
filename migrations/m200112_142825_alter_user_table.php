<?php

use yii\db\Migration;

/**
 * Class m200112_142825_alter_user_table
 */
class m200112_142825_alter_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn(
            '{{%user}}',
            'email',
            $this->string(255)->null()
        );

        $this->addColumn('{{%user}}', 'access_token', $this->string(32)->notNull()->after('auth_key'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn(
            '{{%user}}',
            'email',
            $this->string(255)->notNull()
        );

        $this->dropColumn('{{%user}}', 'access_token');
    }
}
