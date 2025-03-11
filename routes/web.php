<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Public routes (accessible to everyone)
Route::middleware('guest')->group(function () {
    // Login routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Registration routes
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Protected routes (require authentication)
Route::middleware('auth')->group(function () {
    // Logout route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin routes
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
});

// Default route
Route::get('/', function () {
    return view('welcome');
});