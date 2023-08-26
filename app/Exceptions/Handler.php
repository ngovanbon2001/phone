<?php

namespace App\Exceptions;

use App\Http\Controllers\Traits\ApiResponse;
use Facade\FlareClient\Http\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class Handler extends ExceptionHandler
{
    use ApiResponse;

    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $exception
     * @return Response|JsonResponse|RedirectResponse
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {
            return $this->apiHandleException($exception);
        }
        return parent::render($request, $exception);
    }

    /**
     * @param $exception
     * @return JsonResponse
     */
    private function apiHandleException($exception): JsonResponse
    {
        if ($exception instanceof MethodNotAllowedHttpException) {
            $response = $this->fail(
                $exception->getMessage(),
                ResponseAlias::HTTP_METHOD_NOT_ALLOWED
            );
        } elseif ($exception instanceof ValidationException) {
            $errors   = $exception->errors();
            $error    = collect($errors)->first();
            $errorStr = $error ? $error[0] : '';
            $response = $this->fail($errorStr);
        } elseif ($exception instanceof NotFoundHttpException) {
            $response = $this->fail(
                'Request not found',
                ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            );
        } elseif ($exception instanceof CartException) {
            $response = $this->fail(
                'Request not found',
                ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            );
        } else {
            Log::info('[RENDER EXCEPTION] - ' . $exception->getMessage());
            $response = $this->fail($exception->getMessage());
        }

        return $response;
    }
}
