<?php

namespace app\api\components;

use Yii;
use yii\web\BadRequestHttpException;

/**
 * Trait RequestTrait
 * @package zhongq0930\qyii\base
 */
trait RequestTrait
{
    /**
     * @throws BadRequestHttpException
     */
    protected function requirePostRequest()
    {
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException('必须使用 POST 方法请求');
        }
    }

    /**
     * @param string $name
     * @param null $defaultValue
     * @return mixed
     */
    protected function getQueryParam(string $name, $defaultValue = null)
    {
        return Yii::$app->request->getQueryParam($name, $defaultValue);
    }

    /**
     * @param string $name
     * @return mixed
     * @throws BadRequestHttpException
     */
    protected function getRequiredQueryParam(string $name)
    {
        $value = $this->getQueryParam($name);

        if ($value !== null) {
            return $value;
        }

        throw new BadRequestHttpException('缺少必须参数: ' . $name);
    }

    /**
     * @param string $name
     * @param null $defaultValue
     * @return mixed
     */
    protected function getBodyParam(string $name, $defaultValue = null)
    {
        return Yii::$app->request->getBodyParam($name, $defaultValue);
    }

    /**
     * @param string $name
     * @return mixed
     * @throws BadRequestHttpException
     */
    protected function getRequiredBodyParam(string $name)
    {
        $value = $this->getBodyParam($name);

        if ($value !== null) {
            return $value;
        }

        throw new BadRequestHttpException('缺少必须参数: ' . $name);
    }
}