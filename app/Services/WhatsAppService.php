<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $apiUrl;
    protected $token;
    protected $senderNumber;
    protected $enabled;

    public function __construct()
    {
        // Mengambil konfigurasi dari .env
        $baseApiUrl = config('services.whatsapp.api_url', 'https://api.ultramsg.com/instance117993/');
        
        // Pastikan URL berakhir dengan endpoint messages/chat untuk UltraMsg
        if (strpos($baseApiUrl, 'ultramsg.com') !== false && !str_ends_with($baseApiUrl, 'messages/chat')) {
            $this->apiUrl = rtrim($baseApiUrl, '/') . '/messages/chat';
        } else {
            $this->apiUrl = $baseApiUrl;
        }
        
        $this->token = config('services.whatsapp.token');
        
        // Mengambil pengaturan dari database jika ada
        $this->senderNumber = Setting::getValue('whatsapp_sender_number') ?? 
                              config('services.whatsapp.sender_number');
        
        $this->enabled = Setting::getValue('whatsapp_enabled') === 'true';
        
        // Log konfigurasi untuk membantu debugging
        Log::info('WhatsApp service initialized', [
            'api_url' => $this->apiUrl,
            'enabled' => $this->enabled,
            'sender_number' => $this->senderNumber
        ]);
    }

    /**
     * Mengirim pesan WhatsApp ke nomor yang ditentukan
     * 
     * @param string $to Nomor penerima (format: 628xxxxxxxxxx)
     * @param string $message Isi pesan
     * @param array $options Opsi tambahan (opsional)
     * @return array Respons dari API
     */
    public function sendMessage(string $to, string $message, array $options = [])
    {
        try {
            // Jika fitur WhatsApp tidak diaktifkan, return early
            if (!$this->enabled) {
                Log::info('WhatsApp notification is disabled');
                return [
                    'success' => false,
                    'error' => 'WhatsApp notification is disabled',
                ];
            }
            
            // Jika nomor pengirim tidak dikonfigurasi, return early
            if (empty($this->senderNumber)) {
                Log::warning('WhatsApp sender number is not configured');
                return [
                    'success' => false,
                    'error' => 'WhatsApp sender number is not configured',
                ];
            }
            
            // Pastikan nomor telepon dalam format yang benar (tanpa +, dan dimulai dengan kode negara)
            $to = $this->formatPhoneNumber($to);
            
            // Create payload sesuai format UltraMsg
            $payload = [
                'token' => $this->token,
                'to' => $to,
                'body' => $message
            ];
            
            // Tambahkan opsi tambahan jika ada
            if (!empty($options)) {
                $payload = array_merge($payload, $options);
            }

            Log::info('Sending WhatsApp message', [
                'to' => $to,
                'api_url' => $this->apiUrl
            ]);

            // Kirim pesan via API dengan content-type application/x-www-form-urlencoded
            $response = Http::asForm()->post($this->apiUrl, $payload);

            Log::info('WhatsApp message sent', [
                'to' => $to,
                'status' => $response->status(),
                'response' => $response->json() ?? $response->body()
            ]);

            return [
                'success' => $response->successful(),
                'data' => $response->json() ?? $response->body(),
            ];
        } catch (\Exception $e) {
            Log::error('WhatsApp message sending failed', [
                'to' => $to,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Mengirim notifikasi konfirmasi booking
     * 
     * @param string $phone Nomor telepon penerima
     * @param array $bookingData Data booking
     * @return array Respons dari API
     */
    public function sendBookingConfirmation(string $phone, array $bookingData)
    {
        // Format pesan dengan format yang didukung WhatsApp
        $message = "*KONFIRMASI BOOKING EZ COLIVING*\n\n";
        $message .= "Halo *{$bookingData['name']}*,\n\n";
        $message .= "Pembayaran Anda telah kami konfirmasi. Booking Anda dengan nomor *{$bookingData['booking_number']}* berhasil.\n\n";
        $message .= "*Detail Booking:*\n";
        $message .= "• Check-in: *{$bookingData['date_in']}*\n";
        $message .= "• Check-out: *{$bookingData['date_out']}*\n";
        $message .= "• Kamar: *{$bookingData['room_name']}*\n";
        $message .= "• Total: *Rp {$bookingData['total_price']}*\n\n";
        $message .= "Terima kasih telah memilih Ez Coliving!\n";
        $message .= "Jika memerlukan bantuan, silakan hubungi kami.";

        return $this->sendMessage($phone, $message);
    }

    /**
     * Format nomor telepon agar sesuai dengan format yang dibutuhkan
     * 
     * @param string $phoneNumber
     * @return string
     */
    protected function formatPhoneNumber(string $phoneNumber)
    {
        // Hapus karakter non-numerik
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        
        // Hapus 0 di awal jika ada dan ganti dengan kode negara (62 untuk Indonesia)
        if (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = '62' . substr($phoneNumber, 1);
        }
        
        // Pastikan dimulai dengan kode negara
        if (substr($phoneNumber, 0, 2) !== '62') {
            $phoneNumber = '62' . $phoneNumber;
        }
        
        return $phoneNumber;
    }
} 