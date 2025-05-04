<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateRoomStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rooms:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update room status to available if checkout date has passed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now()->startOfDay();
        
        // Cari semua booking yang tanggal checkout-nya sudah lewat dan statusnya masih 'Booked'
        $expiredBookings = Booking::where('booking_date_out', '<', $today)
            ->where('booking_status', 'Confirmed')
            ->with('room')
            ->get();
            
        $count = 0;
        
        foreach ($expiredBookings as $booking) {
            if ($booking->room) {
                // Update status kamar menjadi available
                $booking->room->update([
                    'room_status' => 'Available',
                    'name_booking' => null,
                    'phone_booking' => null,
                    'date_booking' => null,
                    'date_booking_in' => null,
                    'date_booking_out' => null
                ]);
                
                // Update status booking menjadi 'Completed'
                $booking->update(['booking_status' => 'Completed']);
                
                $count++;
                
                Log::info('Updated room status to Available', [
                    'room_id' => $booking->room->id,
                    'room_number' => $booking->room->room_number,
                    'booking_id' => $booking->id,
                    'checkout_date' => $booking->booking_date_out
                ]);
            }
        }
        
        $this->info("Successfully updated {$count} rooms to Available status");
        return 0;
    }
} 