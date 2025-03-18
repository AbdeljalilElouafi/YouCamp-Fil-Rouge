<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AdminManagerController;


Route::middleware('guest')->group(function () {
    
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {

});


// Password reset routes
Route::get('/forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [\App\Http\Controllers\Auth\NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [\App\Http\Controllers\Auth\NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

Route::middleware('auth','role:admin')->group(function () {
    
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('/users', function () {
            return view('admin.users');
        })->name('admin.users');

        // Route::get('/managers', function () {
        //     return view('admin.managers');
        // })->name('admin.managers');

        Route::get('/managers', [AdminManagerController::class, 'index'])->name('admin.managers');
        Route::post('/managers/approve/{id}', [AdminManagerController::class, 'approve'])->name('admin.managers.approve');
        Route::post('/managers/reject/{id}', [AdminManagerController::class, 'reject'])->name('admin.managers.reject');

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


Route::get('/pending-activation', function () {
    return view('auth.pending_activation');
})->name('pending.activation');


Route::middleware('auth','role:manager')->group(function () {
    

    
    Route::prefix('manager')->group(function () {
        Route::get('/dashboard', function () {
            return view('manager.dashboard');
        })->name('manager.dashboard');

        // Route::get('/users', function () {
        //     return view('manager.users');
        // })->name('manager.users');

       
    });
});


Route::middleware('auth','role:visitor')->group(function () {
    


    
    Route::prefix('visitor')->group(function () {
        Route::get('/home', function () {
            return view('visitor.home');
        })->name('visitor.home');

        // Route::get('/users', function () {
        //     return view('manager.users');
        // })->name('manager.users');

       
    });
});

Route::get('/', function () {
    return view('welcome');
});