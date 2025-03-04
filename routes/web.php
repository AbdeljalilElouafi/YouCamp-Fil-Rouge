<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/users', function () {
        return view('admin.users');
    })->name('admin.users');

    Route::get('/managers', function () {
        return view('admin.managers');
    })->name('admin.managers');

    Route::get('/categories', function () {
        return view('admin.categories');
    })->name('admin.categories');

    Route::get('/tags', function () {
        return view('admin.tags');
    })->name('admin.tags');

    Route::get('/posts', function () {
        return view('admin.posts');
    })->name('admin.posts');
});




// Route::middleware('auth')->prefix('admin')->group(function () {
   
// });

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
});
