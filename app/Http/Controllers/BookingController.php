<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuestUser;

class BookingController extends Controller
{
    public function addToCart(Request $request)
    {
        $guestUser = session('guest_user');
        $cartData = $guestUser->cart_data ?? [];
        
        // Tambahkan item baru ke cart
        $cartData[] = [
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'added_at' => now()
        ];

        // Update cart data
        $guestUser->update(['cart_data' => $cartData]);

        return response()->json([
            'message' => 'Kamar berhasil ditambahkan ke keranjang',
            'cart' => $cartData
        ]);
    }

    public function confirmBooking(Request $request)
    {
        $guestUser = session('guest_user');
        $bookingHistory = $guestUser->booking_history ?? [];
        
        // Pindahkan data dari cart ke booking history
        $bookingHistory[] = [
            'booking_id' => uniqid('BK-'),
            'items' => $guestUser->cart_data,
            'booked_at' => now(),
            'status' => 'pending'
        ];

        // Update data
        $guestUser->update([
            'booking_history' => $bookingHistory,
            'cart_data' => [] // Kosongkan cart
        ]);

        return response()->json([
            'message' => 'Booking berhasil dibuat',
            'booking' => end($bookingHistory)
        ]);
    }

    public function getBookingHistory()
    {
        $guestUser = session('guest_user');
        return response()->json([
            'history' => $guestUser->booking_history ?? []
        ]);
    }
} 