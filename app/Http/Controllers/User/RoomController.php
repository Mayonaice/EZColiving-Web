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
        $rooms = Room::where('room_status', 'Available')
                    ->orderBy('room_type', 'asc')
                    ->orderBy('room_number', 'asc')
                    ->get();

        return view('user.rooms.index', compact('rooms'));
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);
        return view('user.rooms.show', compact('room'));
    }
} 