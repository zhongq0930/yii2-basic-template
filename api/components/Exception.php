<?php

namespace app\api\components;

use Throwable;
use yii\base\UserException;

/**
 * Class Exception
 * @package app\api\components
 */
class Exception extends UserException
{
    public function __construct($message, $code = ErrorCode::UNSPECIFIED_ERROR, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}