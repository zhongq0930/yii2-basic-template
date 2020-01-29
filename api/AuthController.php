<?php

namespace app\api;

use app\api\components\Controller;
use app\api\components\Exception;
use app\modules\user\models\User;
use dektrium\user\helpers\Password;

/**
 * Class AuthController
 * @package app\api
 */
class AuthController extends Controller
{
    /**
     * @return array
     * @throws Exception
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionLogin()
    {
        $this->requirePostRequest();

        $username = $this->getRequiredBodyParam('username');
        $password = $this->getRequiredBodyParam('password');

        $user = User::findOne([
            'username' => $username
        ]);

        if (empty($user)) {
            throw new Exception('用户状态异常');
        }

        if (!Password::validate($password, $user->password_hash)) {
            throw new Exception('账号或者密码错误');
        }

        $this->data = [
            'accessToken' => $user->access_token,
        ];

        return $this->returnResult('登录成功');
    }
}