<?php

use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\TrophyController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

// Guest Routes (Admin Login View & Processing)
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showSignin'])->name('signin');
    Route::post('/sign-in', [AuthController::class, 'signin'])->name('signin.submit');
    Route::get('/sign-up', [AuthController::class, 'showSignUp'])->name('signup');
    Route::post('/sign-up', [AuthController::class, 'signup'])->name('signup.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    // ======== trophy controller ==========
     Route::get('/categories',[TrophyController::class, 'categories'])->name('categories.all');
     Route::get('/trophies',[TrophyController::class, 'all'])->name('trophies.all');
     Route::get('/trophies/{product}',[TrophyController::class, 'show'])->name('trophies.show');
     Route::get('/contact-us', [UserController::class, 'showExecutives'])->name('executives');
}); 



// Route::middleware("auth")->group(function(){
Route::prefix('/admin')->name('admin.')->group(function () {
    Route::get('/contacts', [AdminController::class, 'contacts'])->name("contacts"); // name: admin.contacts
    Route::get('/users', [AdminController::class, 'users'])->name("users");       // name: admin.users
    Route::get('/trophies/{product}', [UserController::class, 'show'])->name('trophies.show'); // name: admin.trophies.show
});
   
// });


// Protected Admin Dashboard Routes
// Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

//     // Auth Management
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//     // Dashboard Overview
//     Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

//     // Users & Device Requests Management
//     Route::get('/users', [AdminController::class, 'usersIndex'])->name('users.index');
//     Route::patch('/users/{user}/status', [AdminController::class, 'updateStatus'])->name('users.updateStatus');
//     Route::patch('/users/{user}/reset-device', [AdminController::class, 'resetDevice'])->name('users.resetDevice');

//     // Core Content CRUD Shortcuts (Placeholders targeting your resourceful layouts)
//     Route::resource('categories', \App\Http\Controllers\Web\CategoryController::class);
//     Route::resource('products', \App\Http\Controllers\Web\ProductController::class);
//     Route::resource('contacts', \App\Http\Controllers\Web\ContactController::class);
// });
