<?php

use yii\web\Response;

return [
    'id' => 'basic-api',
    'controllerNamespace' => 'app\\api',
    'defaultRoute' => 'default',
    'components' => [
        'request' => [
            'enableCsrfValidation' => false,
            'enableCookieValidation' => false,
        ],
        'response' => [
            'format' => Response::FORMAT_JSON
        ],
        'errorHandler' => [
            'class' => 'app\api\components\ErrorHandler',
        ],
        'log' => [
            'traceLevel' => 3,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
];
