<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\RoomDamage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Agent\Agent;

class RoomDamageController extends Controller
{
    public function index(Request $request)
    {
        // Ambil device_name dari session
        $deviceName = $request->session()->get('device_name');
        
        // Log untuk debugging
        \Illuminate\Support\Facades\Log::info('Accessing damages index', [
            'device_name' => $deviceName,
            'session_id' => $request->session()->getId(),
            'session_all' => $request->session()->all()
        ]);
        
        // Jika device_name tidak ada di session, coba dapatkan dari user agent
        if (!$deviceName) {
            $agent = new Agent();
            $deviceInfo = [
                'device' => $agent->device() ?? 'unknown',
                'platform' => $agent->platform() ?? 'unknown',
                'is_mobile' => $agent->isMobile(),
                'is_tablet' => $agent->isTablet(),
                'is_desktop' => $agent->isDesktop(),
                'ip_address' => $request->ip()
            ];
            
            $deviceName = md5($deviceInfo['device'] . $deviceInfo['platform']);
            
            // Simpan ke session
            $request->session()->put('device_name', $deviceName);
            
            \Illuminate\Support\Facades\Log::info('Generated device_name from agent', [
                'device_name' => $deviceName,
                'device_info' => $deviceInfo
            ]);
        }
        
        // Dapatkan guest user berdasarkan device_name
        $guestUser = \App\Models\GuestUser::where('device_name', $deviceName)->first();
        
        if (!$guestUser) {
            \Illuminate\Support\Facades\Log::warning('Guest user not found', [
                'device_name' => $deviceName
            ]);
            return redirect()->route('userhome')
                ->with('error', 'Anda harus login terlebih dahulu.');
        }
        
        // Ambil data kerusakan kamar milik guest user
        $damages = RoomDamage::with(['room', 'damageCategory'])
            ->where('guest_user_id', $guestUser->id)
            ->latest()
            ->get();
            
        return view('user.damages.index', compact('damages'));
    }
    
    public function show(Request $request, $id)
    {
        // Ambil device_name dari session
        $deviceName = $request->session()->get('device_name');
        
        // Log untuk debugging
        \Illuminate\Support\Facades\Log::info('Accessing damages show', [
            'device_name' => $deviceName,
            'damage_id' => $id,
            'session_id' => $request->session()->getId()
        ]);
        
        // Jika device_name tidak ada di session, coba dapatkan dari user agent
        if (!$deviceName) {
            $agent = new \Jenssegers\Agent\Agent();
            $deviceInfo = [
                'device' => $agent->device() ?? 'unknown',
                'platform' => $agent->platform() ?? 'unknown',
                'is_mobile' => $agent->isMobile(),
                'is_tablet' => $agent->isTablet(),
                'is_desktop' => $agent->isDesktop(),
                'ip_address' => $request->ip()
            ];
            
            $deviceName = md5($deviceInfo['device'] . $deviceInfo['platform']);
            
            // Simpan ke session
            $request->session()->put('device_name', $deviceName);
            
            \Illuminate\Support\Facades\Log::info('Generated device_name from agent for show', [
                'device_name' => $deviceName,
                'device_info' => $deviceInfo
            ]);
        }
        
        // Dapatkan guest user berdasarkan device_name
        $guestUser = \App\Models\GuestUser::where('device_name', $deviceName)->first();
        
        if (!$guestUser) {
            \Illuminate\Support\Facades\Log::warning('Guest user not found for show', [
                'device_name' => $deviceName,
                'damage_id' => $id
            ]);
            return redirect()->route('userhome')
                ->with('error', 'Anda harus login terlebih dahulu.');
        }
        
        // Ambil data kerusakan kamar
        $damage = RoomDamage::with(['room', 'damageCategory'])
            ->where('id', $id)
            ->where('guest_user_id', $guestUser->id)
            ->firstOrFail();
            
        return view('user.damages.show', compact('damage'));
    }
    
    public function uploadPayment(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        // Ambil device_name dari session
        $deviceName = $request->session()->get('device_name');
        
        // Log untuk debugging
        \Illuminate\Support\Facades\Log::info('Uploading payment', [
            'device_name' => $deviceName,
            'damage_id' => $id,
            'session_id' => $request->session()->getId()
        ]);
        
        // Jika device_name tidak ada di session, coba dapatkan dari user agent
        if (!$deviceName) {
            $agent = new \Jenssegers\Agent\Agent();
            $deviceInfo = [
                'device' => $agent->device() ?? 'unknown',
                'platform' => $agent->platform() ?? 'unknown',
                'is_mobile' => $agent->isMobile(),
                'is_tablet' => $agent->isTablet(),
                'is_desktop' => $agent->isDesktop(),
                'ip_address' => $request->ip()
            ];
            
            $deviceName = md5($deviceInfo['device'] . $deviceInfo['platform']);
            
            // Simpan ke session
            $request->session()->put('device_name', $deviceName);
            
            \Illuminate\Support\Facades\Log::info('Generated device_name from agent for payment', [
                'device_name' => $deviceName,
                'device_info' => $deviceInfo
            ]);
        }
        
        // Dapatkan guest user berdasarkan device_name
        $guestUser = \App\Models\GuestUser::where('device_name', $deviceName)->first();
        
        if (!$guestUser) {
            \Illuminate\Support\Facades\Log::warning('Guest user not found for payment', [
                'device_name' => $deviceName,
                'damage_id' => $id
            ]);
            return redirect()->route('userhome')
                ->with('error', 'Anda harus login terlebih dahulu.');
        }
        
        // Ambil data kerusakan kamar
        $damage = RoomDamage::where('id', $id)
            ->where('guest_user_id', $guestUser->id)
            ->firstOrFail();
            
        // Simpan bukti pembayaran
        if ($request->hasFile('payment_proof')) {
            if ($damage->payment_proof) {
                Storage::delete('public/damage-payments/' . $damage->payment_proof);
            }
            
            $file = $request->file('payment_proof');
            $filename = 'damage_payment_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('damage-payments', $filename, 'public');
            
            // Update status pembayaran
            $damage->update([
                'payment_proof' => $filename,
                'payment_status' => 'Pending',
                'payment_date' => now(),
            ]);
        }
        
        return redirect()->route('damages.show', $damage->id)
            ->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu konfirmasi admin.');
    }
} 