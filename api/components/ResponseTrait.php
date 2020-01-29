<?php

namespace app\api\components;

/**
 * Trait ResponseTrait
 * @package zhongq0930\qyii\api
 */
trait ResponseTrait
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @param $message
     * @return array
     */
    protected function returnResult($message)
    {
        $response = [
            'errorCode' => ErrorCode::OK,
            'message' => $message,
        ];

        if ($this->data !== null) $response['data'] = $this->data;

        return $response;
    }
}