<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use RuntimeException;
use Symfony\Component\HttpFoundation\Exception\JsonException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if($exception instanceof ModelNotFoundException){
            return response()->json([
                'error' => 'Resource not found'
            ], 404);
        }

        if($exception instanceof NotFoundHttpException){
            return response()->json([
                'error' => 'Resource not found'
            ], 404);
        }

        if($exception instanceof MethodNotAllowedHttpException){
            return response()->json([
                'error' => 'Method not allowed'
            ], 405);
        }

        if($exception instanceof JsonException){
            return response()->json([
                'error' => 'Method not allowed'
            ], 400);
        }

        if($exception instanceof QueryException){
            return response()->json([
                'error' => 'Database not found'
            ], 404);
        }

        if($exception instanceof RuntimeException){
            return response()->json([
                'error' => 'Runtime error'
            ], 404);
        }

        return parent::render($request, $exception);
    }
}
