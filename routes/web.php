<?php

use App\Http\Controllers\Web\Admin\CategoryController;
use App\Http\Controllers\Web\Admin\ContactController;
use App\Http\Controllers\Web\Admin\ProductController;
use App\Http\Controllers\Web\Admin\SettingController;
use App\Http\Controllers\Web\Admin\UserController as AdminUserController;
use App\Http\Controllers\Web\AdminAuthController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\PrivacyPolicyController;
use App\Http\Controllers\Web\TrophyController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

/* =========Guest Routes ========= */
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showSignin'])->name('signin');
    Route::post('/login', [AuthController::class, 'signin'])->name('signin.submit');
    Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.signin');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.signin.submit');
    Route::get('/admin/verify-login', [AdminAuthController::class, 'showTwoFactor'])->name('admin.2fa.show');
    Route::post('/admin/verify-login', [AdminAuthController::class, 'verifyTwoFactor'])->name('admin.2fa.verify');
    Route::get('/sign-up', [AuthController::class, 'showSignUp'])->name('signup');
    Route::post('/sign-up', [AuthController::class, 'signup'])->name('signup.submit');
});

Route::get('/', [TrophyController::class, 'categories'])->name('home');
Route::get('/categories', [TrophyController::class, 'categories'])->name('categories.all');
Route::get('/categories/{category}/trophies', [TrophyController::class, 'all'])->name('trophies.all');
Route::get('/categories/{category}/trophies/{product}', [TrophyController::class, 'show'])->name('trophies.show');
Route::get('/contact-us', [UserController::class, 'showExecutives'])->name('executives');
Route::get('/privacy-policy', [PrivacyPolicyController::class, 'show'])->name('privacy-policy.show');

Route::middleware('auth')->group(function () {
    /* ====== common auth routes ========= */
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::delete('/account', [AuthController::class, 'destroyAccount'])->name('account.destroy');

    /* ======== admin routes ========= */
    Route::prefix('/admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::resource('/users', AdminUserController::class);
        Route::resource('/categories', CategoryController::class);
        Route::resource('/products', ProductController::class);
        Route::resource('/contacts', ContactController::class);
        Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
        Route::put('/settings/privacy-policy', [SettingController::class, 'updatePrivacyPolicy'])->name('settings.privacy-policy.update');
        Route::post('/settings/two-factor/enable', [SettingController::class, 'enableTwoFactor'])->name('settings.two-factor.enable');
        Route::post('/settings/two-factor/confirm', [SettingController::class, 'confirmTwoFactor'])->name('settings.two-factor.confirm');
        Route::post('/settings/two-factor/cancel', [SettingController::class, 'cancelTwoFactorSetup'])->name('settings.two-factor.cancel');
        Route::post('/settings/two-factor/disable', [SettingController::class, 'disableTwoFactor'])->name('settings.two-factor.disable');
    });
});
