<?php

namespace app\api\components;

use Yii;
use yii\base\UserException;
use yii\web\HttpException;
use yii\web\Response;

/**
 * Class ErrorHandler
 * @package app\api\components
 */
class ErrorHandler extends \yii\base\ErrorHandler
{
    /**
     * @inheritDoc
     */
    protected function renderException($exception)
    {
        if (Yii::$app->has('response')) {
            $response = Yii::$app->getResponse();

            $response->isSent = false;
            $response->stream = null;
            $response->data = null;
            $response->content = null;
        } else {
            $response = new Response();
        }

        $response->data = $this->convertExceptionToArray($exception);

        $response->send();
    }

    /**
     * @param $exception
     * @return array
     */
    protected function convertExceptionToArray($exception)
    {
        if (!YII_DEBUG && !$exception instanceof UserException && !$exception instanceof HttpException) {
            $exception = new HttpException(500, Yii::t('yii', 'An internal server error occurred.'));
        }

        $array = [
            'message' => $exception->getMessage(),
            'errorCode' => $exception->getCode(),
        ];

        if (YII_DEBUG) {
            if (!$exception instanceof UserException) {
                $array['file'] = $exception->getFile();
                $array['line'] = $exception->getLine();
                $array['stack-trace'] = explode("\n", $exception->getTraceAsString());
                if ($exception instanceof \yii\db\Exception) {
                    $array['error-info'] = $exception->errorInfo;
                }
            }

            if (($prev = $exception->getPrevious()) !== null) {
                $array['previous'] = $this->convertExceptionToArray($prev);
            }
        }

        return $array;
    }
}