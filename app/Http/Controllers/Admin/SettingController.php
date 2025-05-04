<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    public function index()
    {
        // Ambil semua pengaturan
        $settings = Setting::all()->keyBy('key');
        
        return view('admin.settings.index', compact('settings'));
    }
    
    public function whatsapp()
    {
        // Ambil pengaturan WhatsApp
        $whatsappSettings = [
            'whatsapp_enabled' => Setting::getValue('whatsapp_enabled', 'false'),
            'whatsapp_sender_number' => Setting::getValue('whatsapp_sender_number', ''),
        ];
        
        return view('admin.settings.whatsapp', compact('whatsappSettings'));
    }
    
    public function updateWhatsapp(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'whatsapp_enabled' => 'required|in:true,false',
            'whatsapp_sender_number' => 'nullable|string|max:20',
        ]);
        
        try {
            // Update pengaturan
            Setting::setValue('whatsapp_enabled', $validated['whatsapp_enabled']);
            Setting::setValue('whatsapp_sender_number', $validated['whatsapp_sender_number']);
            
            Log::info('WhatsApp settings updated', [
                'enabled' => $validated['whatsapp_enabled'],
                'sender_number' => $validated['whatsapp_sender_number'],
            ]);
            
            return redirect()->back()->with('success', 'Pengaturan WhatsApp berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Failed to update WhatsApp settings', ['error' => $e->getMessage()]);
            
            return redirect()->back()
                ->with('error', 'Gagal memperbarui pengaturan WhatsApp: ' . $e->getMessage())
                ->withInput();
        }
    }
} 