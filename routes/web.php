<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AdminManagerController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Manager\DashboardController;
use \App\Http\Controllers\AubergeController;
use \App\Http\Controllers\ReservationController;
use App\Models\Auberge;




Route::get('/regions/{region}/villes', function (Region $region) {
    return $region->villes;
});


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

        Route::get('/tags', [TagController::class, 'index'])->name('admin.tags.index');
        Route::get('/tags/create', [TagController::class, 'create'])->name('admin.tags.create');
        Route::post('/tags', [TagController::class, 'store'])->name('admin.tags.store');
        Route::get('/tags/{id}/edit', [TagController::class, 'edit'])->name('admin.tags.edit');
        Route::put('/tags/{id}', [TagController::class, 'update'])->name('admin.tags.update');
        Route::delete('/tags/{id}', [TagController::class, 'destroy'])->name('admin.tags.destroy');


        Route::get('/services', [ServiceController::class, 'index'])->name('admin.services.index');
        Route::get('/services/create', [ServiceController::class, 'create'])->name('admin.services.create');
        Route::post('/services', [ServiceController::class, 'store'])->name('admin.services.store');
        Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
        Route::put('/services/{id}', [ServiceController::class, 'update'])->name('admin.services.update');
        Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');

       
        

        Route::get('/posts', function () {
            return view('admin.posts');
        })->name('admin.posts');
    });
});

Route::get('/regions/{region}/villes', function (App\Models\Region $region) {
    return response()->json($region->villes);
})->name('api.regions.villes');

Route::get('/manager/auberges/room-form', [AubergeController::class, 'roomForm'])
    ->name('manager.auberges.room-form');


Route::get('/pending-activation', function () {
    return view('auth.pending_activation');
})->name('pending.activation');

Route::middleware(['auth'])->group(function () {
    // Auberge routes
    Route::get('/auberges', [AubergeController::class, 'index'])->name('auberges.index');
    Route::get('/auberges/create', [AubergeController::class, 'create'])->name('auberges.create');
    Route::post('/auberges', [AubergeController::class, 'store'])->name('auberges.store');
    Route::get('/auberges/{auberge}', [AubergeController::class, 'show'])->name('auberges.show');
    Route::get('/auberges/{auberge}/edit', [AubergeController::class, 'edit'])->name('auberges.edit');
    Route::put('/auberges/{auberge}', [AubergeController::class, 'update'])->name('auberges.update');
    Route::delete('/auberges/{auberge}', [AubergeController::class, 'destroy'])->name('auberges.destroy');
    Route::get('/my-auberges', [AubergeController::class, 'myAuberges'])->name('auberges.my');
});

Route::get('/auberges', [AubergeController::class, 'index'])->name('auberges.index');
Route::get('/auberges/{auberge}', [AubergeController::class, 'show'])->name('auberges.show');

Route::middleware(['auth'])->group(function () {
    
    
    
    Route::middleware('role:manager')->prefix('manager')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('manager.dashboard');
    });
});

Route::middleware(['auth', 'role:visitor'])->group(function () {
    Route::resource('reservations', ReservationController::class)->except(['index', 'show']);
});

Route::middleware('auth')->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
});

Route::get('/reservations/{reservation}/payment/success', [ReservationController::class, 'paymentSuccess'])
    ->name('payment.success');
Route::get('/reservations/{reservation}/payment/cancel', [ReservationController::class, 'paymentCancel'])
    ->name('payment.cancel');

    Route::middleware(['auth', 'role:visitor'])->group(function () {
        Route::prefix('visitor')->group(function () {
            Route::get('/home', [\App\Http\Controllers\Visitor\HomeController::class, 'index'])
                ->name('visitor.home');
            
        });
    });


Route::post('/stripe/webhook', function (Request $request) {
    $payload = $request->getContent();
    $sig_header = $request->header('Stripe-Signature');
    $endpoint_secret = config('services.stripe.webhook_secret');

    try {
        $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $endpoint_secret
        );
    } catch (\Exception $e) {
        return response('Invalid signature', 400);
    }

    
    if ($event->type === 'checkout.session.completed') {
        $session = $event->data->object;
        $reservation = Reservation::find($session->metadata->reservation_id);
        
        if ($reservation && $session->payment_status === 'paid') {
            $reservation->update([
                'status' => 'confirmed',
                'paid_at' => now()
            ]);
        }
    }

    return response('Success', 200);
});



Route::get('/', function () {
    $auberges = Auberge::with(['featuredPhoto'])
        ->where('is_active', true)
        ->where('is_featured', true)
        ->take(6)
        ->get();

    return view('welcome', [
        'auberges' => $auberges
    ]);
});