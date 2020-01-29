<?php

namespace app\api\components;

use Yii;
use yii\web\ForbiddenHttpException;

/**
 * Trait PermissionTrait
 * @package zhongq0930\qyii\api
 */
trait PermissionTrait
{
    /**
     * @param string $permissionName
     * @throws ForbiddenHttpException
     */
    protected function requirePermission(string $permissionName)
    {
        $user = Yii::$app->user;

        if (!($user->identity && $user->can($permissionName))) {
            throw new ForbiddenHttpException('没有访问权限，请联系管理员进行设置');
        }
    }
}