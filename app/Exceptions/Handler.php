<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
            return response()->json([
                'status' => 'error',
                'code' => '404',
                'title' => 'Not Found',
                'message' => 'Resource not found.',
                'method' => request()->method(),
                'url' => request()->fullUrl(),
            ], 404);
        }

        if ($exception instanceof NotFoundHttpException && $request->wantsJson()) {
            return response()->json([
                'status' => 'error',
                'code' => '404',
                'title' => 'Not Found',
                'message' => 'Route not found.',
                'method' => request()->method(),
                'url' => request()->fullUrl(),
            ], 404);
        }

        if ($exception instanceof AuthorizationException && $request->wantsJson()) {
            return response()->json([
                'status' => 'error',
                'code' => '403',
                'title' => 'Forbidden',
                'message' => 'This action is unauthorized.',
                'method' => request()->method(),
                'url' => request()->fullUrl(),
            ], 403);
        }

        if ($exception instanceof AuthenticationException && $request->wantsJson()) {
            return response()->json([
                'status' => 'error',
                'code' => '401',
                'title' => 'Unauthorized',
                'message' => 'Unauthenticated.',
                'method' => request()->method(),
                'url' => request()->fullUrl(),
            ], 401);
        }

        if ($exception instanceof MethodNotAllowedHttpException && $request->wantsJson()) {
            $method = request()->method();
            $methods = [
                'GET' => 'GET', 
                'POST' => 'POST', 
                'DELETE' => 'DELETE', 
                'PUT' => 'PUT', 
                'HEAD' => 'HEAD'
            ];
            $filtered = array_values(array_except($methods, 'POST'));
            $suggested = collect($filtered)->implode(', ');

            return response()->json([
                'status' => 'error',
                'code' => '405',
                'title' => 'Method Not Allowed',
                'message' => "The {$method} method is not supported for this route. Try any of the following: {$suggested}",
                'method' => request()->method(),
                'url' => request()->fullUrl(),
            ], 405);
        }

        return parent::render($request, $exception);
    }
}
