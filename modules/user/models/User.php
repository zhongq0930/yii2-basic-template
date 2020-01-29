<?php

namespace app\modules\user\models;

use dektrium\user\models\User as BaseUser;

/**
 * Class User
 * @package app\models
 *
 * @property string $access_token
 */
class User extends BaseUser
{
    public $accessToken;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $rules = parent::rules();

        unset($rules['emailRequired']);

        return $rules;
    }

    /**
     * {@inheritdoc}
     * @throws \yii\base\Exception
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->setAttribute('access_token', \Yii::$app->security->generateRandomString());
        }

        if ($this->email === '') {
            $this->email = null;
        }

        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne([
            'access_token' => $token
        ]);
    }
}
