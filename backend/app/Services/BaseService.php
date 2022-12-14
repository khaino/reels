<?php

namespace App\Services;

class BaseService
{
    const SUCCESS = 0;
    const ERROR = 1;
    const DB_ERROR = 2;
    const VALIDATION_ERROR = 3;

    protected function formatResponse($code, $data, $message = "")
    {
        return [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];
    }
}
