<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\GuestUser;

class RoomController extends Controller
{
    public function index()
    {
        $query = Room::where('room_status', 'Available');

        // Filter berdasarkan pencarian
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('room_number', 'like', "%{$search}%")
                  ->orWhere('room_type', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan tipe kamar
        if (request('room_type')) {
            $query->where('room_type', request('room_type'));
        }

        // Filter berdasarkan range harga
        if (request('price_range')) {
            $priceRange = explode('-', request('price_range'));
            $query->whereBetween('room_price', [$priceRange[0], $priceRange[1]]);
        }

        // Ambil data kamar yang sudah difilter
        $rooms = $query->orderBy('room_type', 'asc')
                      ->orderBy('room_number', 'asc')
                      ->get();

        // Ambil daftar tipe kamar yang tersedia untuk dropdown
        $roomTypes = Room::distinct()->pluck('room_type');

        return view('user.rooms.index', compact('rooms', 'roomTypes'));
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);
        return view('user.rooms.show', compact('room'));
    }
} 