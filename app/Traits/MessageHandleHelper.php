<?php

namespace App\Traits;

use App\Enums\GeneralEnum;
use App\Exceptions\UserException;
use App\Models\ErrorLog;
use Illuminate\Http\Response as ResponseStatus;
use Illuminate\Support\Facades\Response;

trait MessageHandleHelper
{

    public function response(string $message = null, string $key, int $code, $data = null, array $custom = [])
    {
        $metaData = [
            'status' => $code,
            'message' => $message,
            'key' => $key,
            'error_id' => null
        ];

        $metaData = array_merge($metaData, $custom);

        return Response::json([
            'data' => $data,
            'metaData' => $metaData
        ], $code);
    }

    public function successResponse($data = null, string $message = null, string $key = GeneralEnum::SUCCESS->value, array $custom = [])
    {
        return $this->response($message, $key, ResponseStatus::HTTP_OK, $data, $custom);
    }

    public function exceptionResponse(\Throwable $e, $code = null)
    {
        if ($e instanceof UserException) {
            return response([
                'data' => [],
                'metaData' => [
                    'status' => $e->getCode(),
                    'message' => $e->getMessage(),
                    'key' => $e->getKey(),
                    'error_id' => null
                ]
            ], $e->getCode());
        }

        $error_id = ErrorLog::newError($e, $code);
        $msg = __('messages.something_went_wrong');

        return response([
            'data' => [],
            'metaData' => [
                'status' => ResponseStatus::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $msg,
                'key' => GeneralEnum::INTERNAL_ERROR,
                'error_id' => $error_id
            ]
        ], ResponseStatus::HTTP_INTERNAL_SERVER_ERROR);
    }
}
