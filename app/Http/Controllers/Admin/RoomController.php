<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RoomController extends Controller
{

    public function index()
    {
        $rooms = Room::latest()->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_name' => 'required|string|max:255',
            'room_number' => 'required|string|max:50',
            'room_type' => 'required|string|max:100',
            'room_price' => 'required|string',
            'room_description' => 'required|string',
            'room_status' => 'required|in:Available,Booked,Maintenance',
            'deposit_price' => 'nullable|string',
            'room_image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'room_image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'room_image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'room_image4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'room_image5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except(['room_image1', 'room_image2', 'room_image3', 'room_image4', 'room_image5']);

        for ($i = 1; $i <= 5; $i++) {
            $fieldName = "room_image$i";
            if ($request->hasFile($fieldName)) {
                $image = $request->file($fieldName);
                $filename = 'room_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                $image->storeAs('rooms', $filename, 'public');
                $data[$fieldName] = $filename;
            }
        }

        Room::create($data);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Kamar berhasil ditambahkan!');
    }

    public function show(Room $room)
    {
        return view('admin.rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_name' => 'required|string|max:255',
            'room_number' => 'required|string|max:50',
            'room_type' => 'required|string|max:100',
            'room_price' => 'required|string',
            'room_description' => 'required|string',
            'room_status' => 'required|in:Available,Booked,Maintenance',
            'deposit_price' => 'nullable|string',
            'room_image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'room_image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'room_image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'room_image4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'room_image5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except(['room_image1', 'room_image2', 'room_image3', 'room_image4', 'room_image5']);
        
        for ($i = 1; $i <= 5; $i++) {
            $fieldName = "room_image$i";
            if ($request->hasFile($fieldName)) {
                $oldImageName = $room->{$fieldName};

                if ($oldImageName) {
                    Storage::disk('public')->delete('rooms/' . $oldImageName);
                }
                
                $image = $request->file($fieldName);
                $filename = 'room_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                $image->storeAs('rooms', $filename, 'public');
                $data[$fieldName] = $filename;
            }
        }

        $room->update($data);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Kamar berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        for ($i = 1; $i <= 5; $i++) {
            $fieldName = "room_image$i";
            $imageName = $room->{$fieldName};

            if ($imageName) {
                Storage::disk('public')->delete('rooms/' . $imageName);
            }
        }
        
        $room->delete();

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Kamar berhasil dihapus!');
    }
} 