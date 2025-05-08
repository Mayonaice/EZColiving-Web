<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\User\RoomController as UserRoomController;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Admin\MasterPaymentController;
use App\Http\Controllers\BookingController;
use App\Models\GuestUser;
use App\Http\Middleware\CheckGuestIp;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\BookingHistoryController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\BookingHistoryController as AdminBookingHistoryController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\ExpenseCategoryController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AdminAIController;
use App\Http\Controllers\Admin\DamageCategoryController;
use App\Http\Controllers\Admin\RoomDamageController;
use App\Http\Controllers\User\RoomDamageController as UserRoomDamageController;
use App\Http\Controllers\User\DamageController;

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
            Route::get('home', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('home');
            
            // Room routes
            Route::resource('rooms', RoomController::class);
            Route::post('rooms/{room}/reset-status', [RoomController::class, 'resetRoomStatus'])->name('rooms.reset-status');
            Route::get('rooms/{room}/edit-booking-info', [RoomController::class, 'editBookingInfo'])->name('rooms.edit-booking-info');
            Route::put('rooms/{room}/update-booking-info', [RoomController::class, 'updateBookingInfo'])->name('rooms.update-booking-info');
            Route::post('rooms/{room}/toggle-status', [RoomController::class, 'toggleStatus'])->name('rooms.toggle-status');
            Route::get('rooms/{room}/checkout-damage', [RoomController::class, 'checkoutWithDamage'])->name('rooms.checkout-damage');
            Route::post('rooms/{room}/checkout-damage', [RoomController::class, 'processCheckoutWithDamage'])->name('rooms.process-checkout-damage');
            
            // Damage category routes
            Route::resource('damage-categories', DamageCategoryController::class);
            
            // Room damage routes
            Route::get('room-damages/pending-payments', [RoomDamageController::class, 'pendingPayments'])->name('room-damages.pending-payments');
            Route::post('room-damages/{id}/confirm-payment', [RoomDamageController::class, 'confirmPayment'])->name('room-damages.confirm-payment');
            Route::resource('room-damages', RoomDamageController::class);
            
            Route::resource('masterpayments', MasterPaymentController::class);
            Route::get('denah', [AdminController::class, 'denah'])->name('denah');
            Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
            Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('payments.show');
            Route::post('/payments/{id}/confirm', [PaymentController::class, 'confirm'])->name('payments.confirm');
            Route::post('/payments/{id}/reject', [PaymentController::class, 'reject'])->name('payments.reject');
            
            // Booking history
            Route::get('/bookings', [App\Http\Controllers\Admin\BookingHistoryController::class, 'index'])->name('bookings.index');
            Route::get('/bookings/{id}', [App\Http\Controllers\Admin\BookingHistoryController::class, 'show'])->name('bookings.show');

            // Finance Management Routes
            Route::get('expenses/report', [ExpenseController::class, 'report'])->name('expenses.report');
            Route::resource('expense-categories', ExpenseCategoryController::class);
            Route::resource('expenses', ExpenseController::class);

            // AI Routes
            Route::post('/ai-chat', [AdminAIController::class, 'chat'])->name('ai.chat');
            Route::post('/ai-predict', [AdminAIController::class, 'predict'])->name('ai.predict');
        });
    });
    
    // Settings routes
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/whatsapp', [App\Http\Controllers\Admin\SettingController::class, 'whatsapp'])->name('whatsapp');
        Route::post('/whatsapp', [App\Http\Controllers\Admin\SettingController::class, 'updateWhatsapp'])->name('whatsapp.update');
    });

    // Finance routes
    Route::resource('expense-categories', ExpenseCategoryController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/export', [ReportController::class, 'export'])->name('reports.export');
    Route::get('reports/data', [ReportController::class, 'getData'])->name('reports.data');
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
    Route::get('/rooms', [UserRoomController::class, 'index'])->name('user.rooms.index');
    Route::get('/rooms/{id}', [UserRoomController::class, 'show'])->name('user.rooms.show');
    
    // About Us Route dengan template khusus
    Route::get('/about', function() {
        return view('user.about');
    })->name('user.about');
    
    // Checkout Routes
    Route::get('/checkout/{roomId}', [CheckoutController::class, 'index'])->name('user.checkout.index');
    Route::post('/checkout/{roomId}', [CheckoutController::class, 'store'])->name('user.checkout.store');
    Route::get('/checkout/payment/{bookingId}', [CheckoutController::class, 'payment'])->name('user.checkout.payment');
    Route::post('/checkout/upload-payment/{bookingId}', [CheckoutController::class, 'uploadPayment'])->name('user.checkout.upload-payment');
    Route::get('/checkout/success/{bookingId}', [CheckoutController::class, 'success'])->name('user.checkout.success');
    
    // Room damage routes
    Route::get('/damages', [UserRoomDamageController::class, 'index'])->name('damages.index');
    Route::get('/damages/{id}', [UserRoomDamageController::class, 'show'])->name('damages.show');
    Route::post('/damages/{id}/upload-payment', [UserRoomDamageController::class, 'uploadPayment'])->name('damages.upload-payment');
});

// User routes
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserRoomController::class, 'index'])->name('userhome');
    
    // Checkout routes
    Route::get('/checkout/{roomId}', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/{roomId}', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/payment/{bookingId}', [CheckoutController::class, 'payment'])->name('checkout.payment');
    Route::post('/checkout/payment/{bookingId}', [CheckoutController::class, 'uploadPayment'])->name('checkout.upload');
    Route::get('/checkout/success/{bookingId}', [CheckoutController::class, 'success'])->name('checkout.success');
    
    // Booking history routes
    Route::get('/bookings', [BookingHistoryController::class, 'index'])->name('bookings.history');
    Route::get('/bookings/{booking}', [BookingHistoryController::class, 'show'])->name('bookings.show');
    
    // Room damage routes
    Route::get('/damages', [UserRoomDamageController::class, 'index'])->name('damages.index');
    Route::get('/damages/{id}', [UserRoomDamageController::class, 'show'])->name('damages.show');
    Route::post('/damages/{id}/upload-payment', [UserRoomDamageController::class, 'uploadPayment'])->name('damages.upload-payment');
});

// Untuk debugging WhatsApp setting
Route::get('/debug/whatsapp-settings', function() {
    $settings = App\Models\Setting::all()->toArray();
    $whatsappService = app(App\Services\WhatsAppService::class);
    
    return [
        'settings' => $settings,
        'config' => [
            'api_url' => config('services.whatsapp.api_url'),
            'token' => substr(config('services.whatsapp.token'), 0, 5) . '...',
            'sender_number' => config('services.whatsapp.sender_number')
        ]
    ];
})->middleware(['auth']);

// Untuk testing pengiriman WhatsApp
Route::get('/debug/send-whatsapp-test', function(\Illuminate\Http\Request $request) {
    if (!$request->has('phone')) {
        return ['error' => 'Parameter phone diperlukan'];
    }
    
    $phoneNumber = $request->input('phone');
    $message = $request->input('message', 'Ini adalah pesan test dari Ez Coliving');
    
    $whatsappService = app(App\Services\WhatsAppService::class);
    $result = $whatsappService->sendMessage($phoneNumber, $message);
    
    return [
        'result' => $result,
        'phone' => $phoneNumber,
        'message' => $message
    ];
})->middleware(['auth']);

require __DIR__.'/auth.php';
