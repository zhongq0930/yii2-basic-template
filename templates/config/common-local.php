<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=yii2-basic',
            'username' => 'root',
            'password' => '',
            'tablePrefix' => '',
            'charset' => 'utf8',

            // Schema cache options (for production environment)
            //'enableSchemaCache' => true,
            //'schemaCacheDuration' => 60,
            //'schemaCache' => 'cache',
        ],
    ],
    'params' => require __DIR__ . '/params-local.php',
];

