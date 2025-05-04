<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Room;
use App\Models\MasterPayment;
use App\Models\GuestUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Agent;

class CheckoutController extends Controller
{
    protected $agent;

    public function __construct()
    {
        $this->agent = new Agent();
    }

    public function index($roomId)
    {
        $room = Room::findOrFail($roomId);
        $masterPayments = MasterPayment::where('payment_status', 'Active')->get();
        return view('user.checkout.index', compact('room', 'masterPayments'));
    }

    public function store(Request $request, $roomId)
    {
        Log::info('Checkout process started', [
            'roomId' => $roomId,
            'request' => $request->all()
        ]);

        $room = Room::findOrFail($roomId);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date',
            'rental_type' => 'required|in:daily,monthly',
            'rental_duration' => 'required|integer|min:1',
            'master_payment_id' => 'required|exists:master_payments,id',
            'total_amount' => 'required|numeric|min:0'
        ]);

        // Validasi manual tanggal checkout setelah check-in
        $checkInDate = \Carbon\Carbon::parse($request->check_in_date);
        $checkOutDate = \Carbon\Carbon::parse($request->check_out_date);
        
        if ($checkOutDate->lessThanOrEqualTo($checkInDate)) {
            return back()
                ->withInput()
                ->withErrors(['check_out_date' => 'Tanggal checkout harus setelah tanggal check-in']);
        }

        // Verifikasi perhitungan total_amount berdasarkan jenis sewa dan durasi
        $calculatedAmount = 0;
        $rentalDuration = (int)$request->rental_duration;
        
        if ($request->rental_type === 'monthly') {
            $calculatedAmount = $room->room_price * $rentalDuration;
        } else {
            $calculatedAmount = $room->daily_price * $rentalDuration;
        }
        
        // Tambahkan deposit
        $calculatedAmount += $room->deposit_price;
        
        // Verifikasi total_amount - tambahkan toleransi untuk pembulatan
        if (abs($calculatedAmount - $request->total_amount) > 100) {  // Lebih toleran
            Log::warning('Total amount mismatch', [
                'calculated' => $calculatedAmount,
                'submitted' => $request->total_amount,
                'rental_type' => $request->rental_type,
                'rental_duration' => $rentalDuration,
                'difference' => abs($calculatedAmount - $request->total_amount)
            ]);
            
            // Koreksi total amount, gunakan nilai yang benar
            $request->merge(['total_amount' => $calculatedAmount]);
            Log::info('Total amount corrected to', ['total_amount' => $calculatedAmount]);
        }

        // Verifikasi check_out_date
        $expectedCheckoutDate = null;
        
        if ($request->rental_type === 'monthly') {
            $expectedCheckoutDate = $checkInDate->copy()->addMonths($rentalDuration);
        } else {
            $expectedCheckoutDate = $checkInDate->copy()->addDays($rentalDuration);
        }
        
        // Tambahkan toleransi 1 hari untuk perbedaan perhitungan
        $daysDiff = abs($checkOutDate->diffInDays($expectedCheckoutDate));
        if ($daysDiff > 2) {  // Lebih toleran, 2 hari
            Log::warning('Checkout date mismatch', [
                'expected' => $expectedCheckoutDate->format('Y-m-d'),
                'submitted' => $checkOutDate->format('Y-m-d'),
                'difference_days' => $daysDiff
            ]);
            
            // Gunakan tanggal yang dihitung server sebagai koreksi
            $request->merge(['check_out_date' => $expectedCheckoutDate->format('Y-m-d')]);
            Log::info('Checkout date corrected to', ['check_out_date' => $expectedCheckoutDate->format('Y-m-d')]);
        }

        try {
            DB::beginTransaction();

            // Deteksi device name yang asli
            $deviceName = $this->getDeviceName();
            
            Log::info('Device detection result', [
                'device_name' => $deviceName,
                'user_agent' => $request->header('User-Agent'),
                'is_desktop' => $this->agent->isDesktop(),
                'is_tablet' => $this->agent->isTablet(),
                'is_mobile' => $this->agent->isMobile(),
                'browser' => $this->agent->browser(),
                'platform' => $this->agent->platform()
            ]);
            
            if (empty($deviceName)) {
                Log::error('Device detection failed', [
                    'user_agent' => $request->header('User-Agent')
                ]);
                
                return back()->with('error', 'Tidak dapat mendeteksi perangkat Anda. Silakan coba checkout ulang.');
            }
            
            // Cari guest user berdasarkan device_name
            $guestUser = GuestUser::where('device_name', $deviceName)->first();
            
            Log::info('Guest user search result', [
                'device_name' => $deviceName,
                'guest_user_found' => !is_null($guestUser),
                'guest_user_id' => $guestUser ? $guestUser->id : null
            ]);

            if (!$guestUser) {
                Log::error('Device not found', [
                    'user_agent' => $request->header('User-Agent'),
                    'device_name' => $deviceName
                ]);
                
                return back()
                    ->withInput()
                    ->withErrors(['device' => 'Perangkat Anda tidak terdaftar. Silakan hubungi admin untuk pendaftaran perangkat.']);
            }
            
            Log::info('Existing guest user found', [
                'guest_user_id' => $guestUser->id,
                'current_device' => $deviceName,
                'existing_devices' => is_string($guestUser->device_info) ? json_decode($guestUser->device_info, true) : $guestUser->device_info
            ]);
            
            // Jika ditemukan, cek apakah device sudah terdaftar
            $existingDevices = is_string($guestUser->device_info) ? json_decode($guestUser->device_info, true) : $guestUser->device_info;
            $existingDevices = is_array($existingDevices) ? $existingDevices : [];
            
            if (!in_array($deviceName, $existingDevices)) {
                Log::info('Adding new device to guest user', [
                    'guest_user_id' => $guestUser->id,
                    'new_device' => $deviceName,
                    'previous_devices' => $existingDevices
                ]);
                
                // Jika device belum terdaftar, tambahkan ke daftar
                $existingDevices[] = $deviceName;
                $guestUser->device_info = json_encode($existingDevices);
                $guestUser->save();
                
                Log::info('Device list updated', [
                    'guest_user_id' => $guestUser->id,
                    'updated_devices' => $existingDevices
                ]);
            }

            // Update data guest user
            Log::info('Updating guest user data', [
                'guest_user_id' => $guestUser->id,
                'old_name' => $guestUser->name,
                'new_name' => $request->name,
                'old_phone' => $guestUser->phone,
                'new_phone' => $request->phone,
                'old_device' => $guestUser->device_name,
                'new_device' => $deviceName
            ]);
            
            $guestUser->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'device_name' => $deviceName, // Update device terakhir yang digunakan
                'last_activity' => now()
            ]);

            Log::info('Guest user data updated successfully', [
                'guest_user_id' => $guestUser->id,
                'name' => $guestUser->name,
                'email' => $guestUser->email,
                'phone' => $guestUser->phone,
                'current_device' => $deviceName,
                'all_devices' => is_string($guestUser->device_info) ? json_decode($guestUser->device_info, true) : $guestUser->device_info,
                'last_activity' => $guestUser->last_activity
            ]);

            // 1. Buat payment terlebih dahulu
            $masterPayment = MasterPayment::findOrFail($request->master_payment_id);
            Log::info('Creating payment', [
                'master_payment_id' => $request->master_payment_id,
                'amount' => $request->total_amount
            ]);

            $payment = Payment::create([
                'master_payment_id' => $request->master_payment_id,
                'payment_name' => $masterPayment->payment_name,
                'payment_number' => $masterPayment->payment_account_number,
                'payment_amount' => (string)$request->total_amount,
                'payment_status' => 'Pending'
            ]);

            Log::info('Payment created', ['payment_id' => $payment->id]);

            // 2. Buat booking dengan payment_id
            Log::info('Creating booking', [
                'room_id' => $room->id,
                'guest_user_id' => $guestUser->id,
                'payment_id' => $payment->id,
                'booking_date_in' => $request->check_in_date,
                'booking_date_out' => $request->check_out_date,
                'rental_type' => $request->rental_type,
                'rental_duration' => $request->rental_duration,
                'total_price' => $request->total_amount
            ]);

            $booking = Booking::create([
                'room_id' => $room->id,
                'guest_user_id' => $guestUser->id,
                'payment_id' => $payment->id,
                'name_booking' => $guestUser->name,
                'phone_booking' => $guestUser->phone,
                'email_booking' => $guestUser->email,
                'booking_number' => 'BK-' . time() . rand(1000, 9999),
                'rental_type' => $request->rental_type,
                'rental_duration' => $request->rental_duration,
                'total_price' => (string)$request->total_amount,
                'booking_date' => now(),
                'booking_date_in' => $request->check_in_date,
                'booking_date_out' => $request->check_out_date,
                'booking_status' => 'Pending'
            ]);

            Log::info('Booking created', ['booking_id' => $booking->id]);
            
            // Update data di tabel rooms
            Log::info('Updating room data with booking information', [
                'room_id' => $room->id,
                'booking_date_in' => $request->check_in_date,
                'booking_date_out' => $request->check_out_date
            ]);
            
            $room->update([
                'name_booking' => $guestUser->name,
                'phone_booking' => $guestUser->phone,
                'date_booking' => now(),
                'date_booking_in' => $request->check_in_date,
                'date_booking_out' => $request->check_out_date
            ]);
            
            Log::info('Room data updated successfully', ['room_id' => $room->id]);

            DB::commit();
            Log::info('Transaction committed successfully');

            // Redirect ke halaman pembayaran
            return redirect()->route('user.checkout.payment', $booking->id)
                ->with('success', 'Pemesanan berhasil dibuat! Silakan lakukan pembayaran.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan saat memproses pemesanan. Silakan coba lagi.');
        }
    }

    public function payment($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $payment = $booking->payment;
        $masterPayment = $payment->masterPayment;
        return view('user.checkout.payment', compact('booking', 'payment', 'masterPayment'));
    }

    public function uploadPayment(Request $request, $bookingId)
    {
        $request->validate([
            'payment_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            DB::beginTransaction();

            $booking = Booking::findOrFail($bookingId);
            $payment = $booking->payment;

            // Upload bukti pembayaran
            if ($request->hasFile('payment_image')) {
                $image = $request->file('payment_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/payments'), $imageName);
                
                $payment->update([
                    'payment_image' => 'uploads/payments/' . $imageName,
                    'payment_status' => 'Pending'
                ]);
            }

            DB::commit();

            return redirect()->route('user.checkout.success', $booking->id)
                ->with('success', 'Bukti pembayaran berhasil diupload! Silakan tunggu konfirmasi dari admin.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Upload payment error: ' . $e->getMessage());
            
            return back()->with('error', 'Terjadi kesalahan saat mengupload bukti pembayaran. Silakan coba lagi.');
        }
    }

    public function success($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $payment = $booking->payment;
        return view('user.checkout.success', compact('booking', 'payment'));
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
        
        Log::info('Device detection details', [
            'device_info' => $deviceInfo,
            'device_name' => $deviceName
        ]);
        
        return $deviceName;
    }
} 