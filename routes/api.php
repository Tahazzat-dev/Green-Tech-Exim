<?php 
use App\Http\Controllers\Api\AuthController;


// public routes

// This maps directly to http://127.0.0.1:8000/api
Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the Application API Engine',
        'version' => '1.0.0',
        'status' => 'active'
    ]);
});

Route::get('/health', function () {
    return response()->json(['message' => 'API is working smoothly']);
});

// authentication
Route::post(
    '/register',
    [AuthController::class,'register']
);

Route::post(
    '/login',
    [AuthController::class,'login']
);

Route::middleware('auth:sanctum')
    ->group(function () {

        Route::post(
            '/logout',
            [AuthController::class,'logout']
        );
});
