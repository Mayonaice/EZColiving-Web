<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\RoomController;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Admin\MasterPaymentController;
use App\Http\Controllers\BookingController;
use App\Models\GuestUser;
use App\Http\Middleware\CheckGuestIp;

// Redirect dari root ke userhome
Route::get('/', function () {
    if (Auth::check()) {
        return redirect(RouteServiceProvider::HOME);
    }
    return redirect()->route('userhome');
})->middleware(['web', \App\Http\Middleware\HandleGuestUser::class]);

// Halaman utama user dengan middleware HandleGuestUser
Route::get('/home', function () {
    return view('user.home');
})->name('userhome')->middleware(['web', \App\Http\Middleware\HandleGuestUser::class]);

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

// Routes untuk booking
Route::post('/booking/add-to-cart', [BookingController::class, 'addToCart']);
Route::post('/booking/confirm', [BookingController::class, 'confirmBooking']);
Route::get('/booking/history', [BookingController::class, 'getBookingHistory']);

// Routes untuk testing guest user
Route::get('/check-guest', function() {
    try {
        $deviceInfo = [
            'user_agent' => request()->userAgent(),
            'platform' => request()->header('sec-ch-ua-platform'),
            'mobile' => request()->header('sec-ch-ua-mobile'),
            'device' => request()->header('sec-ch-ua-device')
        ];
        
        $deviceName = md5(json_encode($deviceInfo));
        $existingGuest = GuestUser::where('device_name', $deviceName)->first();
        
        return response()->json([
            'success' => true,
            'device_info' => $deviceInfo,
            'device_name' => $deviceName,
            'existing_guest' => $existingGuest,
            'session_guest' => session('guest_user'),
            'all_guests' => GuestUser::all(),
            'session_id' => session()->getId()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
    }
});

// Route untuk memaksa membuat guest user
Route::get('/force-guest', function() {
    try {
        $deviceInfo = [
            'user_agent' => request()->userAgent(),
            'platform' => request()->header('sec-ch-ua-platform'),
            'mobile' => request()->header('sec-ch-ua-mobile'),
            'device' => request()->header('sec-ch-ua-device')
        ];
        
        $deviceName = md5(json_encode($deviceInfo));
        $guestUser = GuestUser::firstOrCreate(
            ['device_name' => $deviceName],
            [
                'device_info' => json_encode($deviceInfo),
                'last_activity' => now(),
                'cart_data' => json_encode([]),
                'booking_history' => json_encode([])
            ]
        );
        
        return response()->json([
            'success' => true,
            'message' => 'Guest user ' . ($guestUser->wasRecentlyCreated ? 'created' : 'found'),
            'guest_user' => $guestUser
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
    }
});

// User Routes dengan validasi IP
Route::middleware(['web', CheckGuestIp::class])->group(function () {
    Route::get('/rooms', [App\Http\Controllers\User\RoomController::class, 'index'])->name('user.rooms.index');
    Route::get('/rooms/{id}', [App\Http\Controllers\User\RoomController::class, 'show'])->name('user.rooms.show');
});

require __DIR__.'/auth.php';
