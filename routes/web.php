<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\RoomController;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Admin\MasterPaymentController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect(RouteServiceProvider::HOME);
    }
    return redirect()->route('userhome');
});

Route::get('/home', function () {
    return view('user.home');
})->name('userhome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
            Route::get('home', [AdminController::class, 'home'])->name('home');
            Route::resource('rooms', RoomController::class);
            Route::resource('masterpayments', MasterPaymentController::class);
            Route::get('denah', [AdminController::class, 'denah'])->name('denah');
        });
    });
});

require __DIR__.'/auth.php';
