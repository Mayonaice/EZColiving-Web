<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingHistoryController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['room', 'payment', 'guestUser'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('admin.bookings.index', compact('bookings'));
    }
    
    public function show($id)
    {
        $booking = Booking::with(['room', 'payment.masterPayment', 'guestUser'])
            ->findOrFail($id);
            
        return view('admin.bookings.show', compact('booking'));
    }
    
    public function dashboard()
    {
        // Get statistics for dashboard
        $totalRooms = Room::count();
        $availableRooms = Room::where('room_status', 'Available')->count();
        $bookedRooms = Room::where('room_status', 'Booked')->count();
        $maintenanceRooms = Room::where('room_status', 'Maintenance')->count();
        
        $recentBookings = Booking::with(['room', 'payment'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $pendingPayments = Payment::with(['booking.room'])
            ->whereHas('booking')
            ->where('payment_status', 'Pending')
            ->count();
            
        $confirmedPayments = Payment::with(['booking.room'])
            ->whereHas('booking')
            ->where('payment_status', 'Confirmed')
            ->count();
            
        return view('admin.dashboard', compact(
            'totalRooms', 
            'availableRooms', 
            'bookedRooms', 
            'maintenanceRooms',
            'recentBookings',
            'pendingPayments',
            'confirmedPayments'
        ));
    }
} 