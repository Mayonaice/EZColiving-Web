<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Booking;
use App\Models\Room;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $whatsappService;

    public function __construct(WhatsAppService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }

    public function index()
    {
        $payments = Payment::with(['booking.room', 'masterPayment'])
            ->whereHas('booking')
            ->where('payment_status', 'Pending')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function show($id)
    {
        $payment = Payment::with(['booking.room', 'masterPayment'])
            ->whereHas('booking')
            ->findOrFail($id);
        return view('admin.payments.show', compact('payment'));
    }

    public function confirm($id)
    {
        try {
            DB::beginTransaction();
            
            $payment = Payment::whereHas('booking')->findOrFail($id);
            $payment->update(['payment_status' => 'Confirmed']);
            
            // Update status booking menjadi Confirmed
            if ($payment->booking) {
                $payment->booking->update(['booking_status' => 'Confirmed']);
                
                // Update status kamar menjadi Booked
                if ($payment->booking->room) {
                    $payment->booking->room->update([
                        'room_status' => 'Booked'
                    ]);
                    
                    Log::info('Room status updated to Booked', [
                        'room_id' => $payment->booking->room->id,
                        'booking_id' => $payment->booking->id,
                        'payment_id' => $payment->id
                    ]);
                }
                
                // Kirim notifikasi WhatsApp ke pelanggan
                $this->sendWhatsAppNotification($payment->booking);
            }
            
            DB::commit();
            
            return redirect()->route('admin.payments.index')
                ->with('success', 'Pembayaran berhasil dikonfirmasi!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment confirmation error: ' . $e->getMessage());
            
            return back()
                ->with('error', 'Terjadi kesalahan saat mengkonfirmasi pembayaran. Silakan coba lagi.');
        }
    }

    public function reject($id)
    {
        try {
            DB::beginTransaction();
            
            $payment = Payment::whereHas('booking')->findOrFail($id);
            $payment->update(['payment_status' => 'Failed']);
            
            // Update status booking menjadi Rejected
            if ($payment->booking) {
                $payment->booking->update(['booking_status' => 'Rejected']);
                
                // Reset status kamar menjadi Available
                if ($payment->booking->room) {
                    $payment->booking->room->update([
                        'room_status' => 'Available',
                        'name_booking' => null,
                        'phone_booking' => null,
                        'date_booking' => null,
                        'date_booking_in' => null,
                        'date_booking_out' => null
                    ]);
                    
                    Log::info('Room status reset to Available after payment rejection', [
                        'room_id' => $payment->booking->room->id,
                        'booking_id' => $payment->booking->id,
                        'payment_id' => $payment->id
                    ]);
                }
            }
            
            DB::commit();
            
            return redirect()->route('admin.payments.index')
                ->with('success', 'Pembayaran berhasil ditolak!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment rejection error: ' . $e->getMessage());
            
            return back()
                ->with('error', 'Terjadi kesalahan saat menolak pembayaran. Silakan coba lagi.');
        }
    }

    /**
     * Mengirim notifikasi WhatsApp setelah booking dan pembayaran dikonfirmasi
     *
     * @param Booking $booking
     * @return void
     */
    protected function sendWhatsAppNotification(Booking $booking)
    {
        try {
            // Persiapkan data untuk notifikasi
            $bookingData = [
                'name' => $booking->name_booking,
                'booking_number' => $booking->booking_number,
                'date_in' => $booking->booking_date_in->format('d M Y'),
                'date_out' => $booking->booking_date_out->format('d M Y'),
                'room_name' => $booking->room->room_name ?? 'Kamar',
                'total_price' => number_format($booking->total_price, 0, ',', '.'),
            ];

            // Kirim notifikasi WhatsApp
            $result = $this->whatsappService->sendBookingConfirmation(
                $booking->phone_booking,
                $bookingData
            );

            if ($result['success']) {
                Log::info('WhatsApp notification sent for booking', [
                    'booking_id' => $booking->id,
                    'phone' => $booking->phone_booking
                ]);
            } else {
                Log::warning('Failed to send WhatsApp notification', [
                    'booking_id' => $booking->id,
                    'error' => $result['error'] ?? 'Unknown error'
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error sending WhatsApp notification', [
                'booking_id' => $booking->id,
                'error' => $e->getMessage()
            ]);
        }
    }
} 