<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\GuestUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;

class BookingHistoryController extends Controller
{
    protected $agent;

    public function __construct()
    {
        $this->agent = new Agent();
    }

    public function index()
    {
        // Deteksi device user
        $deviceName = $this->getDeviceName();
        
        // Cari guest user berdasarkan device
        $guestUser = GuestUser::where('device_name', $deviceName)->first();
        
        if (!$guestUser) {
            return view('user.bookings.history', ['bookings' => collect([])]);
        }
        
        // Ambil booking history
        $bookings = Booking::with(['room', 'payment'])
            ->where('guest_user_id', $guestUser->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('user.bookings.history', compact('bookings'));
    }
    
    public function show($id)
    {
        // Deteksi device user
        $deviceName = $this->getDeviceName();
        
        // Cari guest user berdasarkan device
        $guestUser = GuestUser::where('device_name', $deviceName)->first();
        
        if (!$guestUser) {
            return redirect()->route('user.bookings.history')
                ->with('error', 'Perangkat tidak dikenali');
        }
        
        // Ambil detail booking
        $booking = Booking::with(['room', 'payment.masterPayment'])
            ->where('id', $id)
            ->where('guest_user_id', $guestUser->id)
            ->firstOrFail();
            
        return view('user.bookings.show', compact('booking'));
    }
    
    private function getDeviceName()
    {
        // Gunakan Agent untuk deteksi device
        $deviceInfo = [
            'device' => $this->agent->device() ?? 'unknown',
            'platform' => $this->agent->platform() ?? 'unknown'
        ];
        
        // Generate hash MD5 dari device dan platform
        $deviceName = md5($deviceInfo['device'] . $deviceInfo['platform']);
        
        Log::info('Device detection details in history', [
            'device_info' => $deviceInfo,
            'device_name' => $deviceName
        ]);
        
        return $deviceName;
    }
} 