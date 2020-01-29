<?php

namespace app\api\components;

/**
 * Class Controller
 * @package app\api\components
 */
class Controller extends \yii\web\Controller
{
    use PermissionTrait;

    use RequestTrait;

    use ResponseTrait;
}