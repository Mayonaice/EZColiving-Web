<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;

class AdminController extends Controller
{
    public function home() {
        $listadmin = User::where('role', 'admin')->get();
        return view('admin.home', compact('listadmin'));
    }
    
    public function denah() {
        // Mengambil semua data kamar
        $rooms = Room::all()->map(function($room) {
            // Menggunakan room_number yang sudah dalam format denah (1BE, 2AA, dll)
            return [
                'id' => $room->id,
                'room_number' => $room->room_number,
                'room_name' => $room->room_name,
                'room_type' => $room->room_type,
                'room_price' => $room->room_price,
                'room_status' => $room->room_status,
                'room_description' => $room->room_description
            ];
        })->values(); // Menggunakan values() untuk memastikan data dalam bentuk array
        
        return view('admin.denah.denah', compact('rooms'));
    }
}
