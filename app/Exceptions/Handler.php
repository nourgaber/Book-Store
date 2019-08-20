<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Services\ResponseService;
class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {
        if ($exception instanceof \App\Exceptions\CustomException) {
              return ResponseService::generateResponseWithError(
                $exception->getCustomExceptionMessage(),
                $exception->getCustomExceptionStatusCode()
            );
        } else {
            //return ResponseService::generateResponseWithError('Unknown Exception',500);
        }

        return parent::render($request, $exception);
    }
}
