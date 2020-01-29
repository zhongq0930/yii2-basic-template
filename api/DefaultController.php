<?php

namespace app\api;

use app\api\components\Controller;
use Yii;
use yii\helpers\Url;

/**
 * Class DefaultController
 * @package app\api
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        $this->data = [
            'apiMap' => $this->getApiMap(),
        ];

        return $this->returnResult('请求初始化接口成功');
    }

    private function getApiMap()
    {
        $baseUrl = Yii::$app->request->baseUrl;

        return [
            'authLogin' => Url::to($baseUrl . '/auth/login', true),
        ];
    }
}