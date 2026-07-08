<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CatalogController;

// public routes

// This maps directly to http://127.0.0.1:8000/api
Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the Application API Engine',
        'version' => '1.0.0',
        'status' => 'active',
    ]);
});

Route::get('/health', function () {
    return response()->json(['success' => true]);
});

Route::get(
    '/categories',
    [CatalogController::class, 'categories']
);

Route::get(
    '/categories/{category}/products',
    [CatalogController::class, 'products']
);

Route::get(
    '/categories/{category}/products/{product}',
    [CatalogController::class, 'product']
);

Route::get(
    '/contacts',
    [CatalogController::class, 'contacts']
);

// authentication
Route::post(
    '/register',
    [AuthController::class, 'register']
);

Route::post(
    '/login',
    [AuthController::class, 'login']
);

Route::middleware('auth:sanctum')
    ->group(function () {

        Route::get(
            '/me',
            [AuthController::class, 'me']
        );

        Route::post(
            '/logout',
            [AuthController::class, 'logout']
        );
    });
