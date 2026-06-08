<?php

use App\Http\Controllers\Web\Admin\CategoryController;
use App\Http\Controllers\Web\Admin\ContactController;
use App\Http\Controllers\Web\Admin\ProductController;
use App\Http\Controllers\Web\Admin\UserController as AdminUserController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\TrophyController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

/* =========Guest Routes ========= */
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showSignin'])->name('signin');
    Route::post('/sign-in', [AuthController::class, 'signin'])->name('signin.submit');
    Route::get('/sign-up', [AuthController::class, 'showSignUp'])->name('signup');
    Route::post('/sign-up', [AuthController::class, 'signup'])->name('signup.submit');
});

Route::middleware('auth')->group(function () {
    /* ====== common auth routes ========= */
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /* ======= user routes ========== */
    Route::middleware('role:user')->group(function () {
        Route::get('/categories', [TrophyController::class, 'categories'])->name('categories.all');
        Route::get('/categories/{category}/trophies', [TrophyController::class, 'all'])->name('trophies.all');
        Route::get('/categories/{category}/trophies/{product}', [TrophyController::class, 'show'])->name('trophies.show');
        Route::get('/contact-us', [UserController::class, 'showExecutives'])->name('executives');
    });

    /* ======== admin routes ========= */
    Route::prefix('/admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::resource('/users', AdminUserController::class);
        Route::resource('/categories', CategoryController::class);
        Route::resource('/trophies', ProductController::class);
        Route::resource('/contacts', ContactController::class);
    });
});
