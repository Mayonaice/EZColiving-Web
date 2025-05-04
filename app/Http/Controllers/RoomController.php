<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $query = Room::query();

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
        $rooms = $query->get();

        // Ambil daftar tipe kamar yang tersedia untuk dropdown
        $roomTypes = Room::distinct()->pluck('room_type');

        return view('user.rooms.index', compact('rooms', 'roomTypes'));
    }

    public function show(Room $room)
    {
        return view('user.rooms.show', compact('room'));
    }
} 