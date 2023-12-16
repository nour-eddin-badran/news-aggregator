<?php

namespace App\Exceptions;

use App\Enums\GeneralEnum;
use App\Traits\MessageHandleHelper;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    use MessageHandleHelper;

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($request->wantsJson()) {
            if ($e instanceof ValidationException) {
                return $this->exceptionResponse(new UserException($e->validator->getMessageBag()->first(), GeneralEnum::VALIDATION, Response::HTTP_UNPROCESSABLE_ENTITY));
            }

            if ($e instanceof AuthenticationException) {
                return $this->exceptionResponse(new UserException(null, GeneralEnum::UNAUTHORIZED, Response::HTTP_UNAUTHORIZED));
            }

            if ($e instanceof ModelNotFoundException) {
                return $this->exceptionResponse(new UserException(__('messages.resource_not_found'), GeneralEnum::NOT_FOUND, Response::HTTP_NOT_FOUND));
            }


            return $this->exceptionResponse($e);
        }

        return parent::render($request, $e);
    }
}
