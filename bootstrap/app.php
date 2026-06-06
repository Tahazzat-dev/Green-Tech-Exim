<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);

        $middleware->redirectGuestsTo(fn () => route('signin'));
    })
    ->withExceptions(function (Exceptions $exceptions) {

        // 1. Force JSON execution for all routes prefixed with 'api/*'
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
            if ($request->is('api/*')) {
                return true;
            }

            return $request->expectsJson();
        });

        // 2. Map relative error context for API requests
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($request->is('api/*')) {

                // Case A: Validation fails (e.g., missed fields, wrong formats)
                if ($e instanceof ValidationException) {
                    return response()->json([
                        'status' => 'error',
                        'type' => 'validation_error',
                        'message' => 'The given data was invalid.',
                        'errors' => $e->errors(), // Returns specific missing fields
                    ], 422);
                }

                // Case B: Route or Model bindings not found (404)
                if ($e instanceof NotFoundHttpException) {
                    return response()->json([
                        'status' => 'error',
                        'type' => 'not_found',
                        'message' => 'The requested endpoint or resource could not be found.',
                    ], 404);
                }

                // Case C: Authentication / Token missing or expired (401)
                if ($e instanceof AuthenticationException) {
                    return response()->json([
                        'status' => 'error',
                        'type' => 'unauthenticated',
                        'message' => 'Unauthenticated. Missing or invalid bearer token.',
                    ], 401);
                }

                // Case D: Fallback for unhandled internal exceptions (e.g., Database/Code syntax errors)
                return response()->json([
                    'status' => 'error',
                    'type' => 'server_error',
                    'message' => config('app.debug') ? $e->getMessage() : 'An unexpected system error occurred.',
                    'file' => config('app.debug') ? $e->getFile() : null,
                    'line' => config('app.debug') ? $e->getLine() : null,
                ], 500);
            }
        });

    })->create();
