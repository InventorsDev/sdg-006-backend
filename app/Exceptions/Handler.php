<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof UnauthorizedHttpException) {
            $preException = $exception->getPrevious();
            // dd($preException);
            if ($preException instanceof
                          \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['error' => 'TOKEN_EXPIRED'], 401);
            } else if ($preException instanceof
                          \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['error' => 'TOKEN_INVALID'], 401);
            } else if ($preException instanceof
                     \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                 return response()->json(['error' => 'TOKEN_BLACKLISTED'], 401);
           }
           if ($exception->getMessage() === 'Token not provided') {
               return response()->json(['error' => 'Token not provided'], 401);
           }
        }
        if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
            return response()->json(['error' => "The resource on which operation is to be carried on does not exist"], 404);
        }
        if ($exception instanceof MethodNotAllowedHttpException && $request->wantsJson()) {
            return response()->json(['error' => "Request Method not supported by this Resource"], 405);
        }
        return parent::render($request, $exception);
    }
}
