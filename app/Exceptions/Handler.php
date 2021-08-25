<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
     * Render an exception into an HTTP response.
     *
     * @param $request
     * @param Throwable $e
     * @return JsonResponse
     */
    public function render($request, \Throwable $e)
    {
        return $this->handleException($e);
    }

    public function handleException(\Throwable $exception) : JsonResponse
    {

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json('Sorry, method not allowed!', 405);
        }
        if ($exception instanceof ModelNotFoundException) {
            return response()->json('Sorry, model not found!', 404);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->json('Sorry, resource not found!', 404);
        }

        if ($exception instanceof HttpException) {
            return response()->json($exception->getMessage(), $exception->getStatusCode());
        }

        if ($exception instanceof QueryException) {

            return response()->json('Sorry, the query has error', 500);
        }
        if ($exception instanceof AuthenticationException) {

            return response()->json('You are not authenticated! Login !', 401);
        }
        return response()->json($exception, 500);

    }

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
}
