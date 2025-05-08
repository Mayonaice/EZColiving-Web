<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomDamage;
use Illuminate\Support\Facades\Storage;

class DamageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil device_name dari session
        $deviceName = $request->session()->get('device_name');
        
        // Dapatkan guest user berdasarkan device_name
        $guestUser = \App\Models\GuestUser::where('device_name', $deviceName)->first();
        
        if (!$guestUser) {
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        // Ambil device_name dari session
        $deviceName = $request->session()->get('device_name');
        
        // Dapatkan guest user berdasarkan device_name
        $guestUser = \App\Models\GuestUser::where('device_name', $deviceName)->first();
        
        if (!$guestUser) {
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Upload bukti pembayaran kerusakan
     */
    public function uploadPayment(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        // Ambil device_name dari session
        $deviceName = $request->session()->get('device_name');
        
        // Dapatkan guest user berdasarkan device_name
        $guestUser = \App\Models\GuestUser::where('device_name', $deviceName)->first();
        
        if (!$guestUser) {
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
