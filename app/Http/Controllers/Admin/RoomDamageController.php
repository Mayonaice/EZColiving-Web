<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DamageCategory;
use App\Models\Room;
use App\Models\RoomDamage;
use App\Models\GuestUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RoomDamageController extends Controller
{
    public function index()
    {
        $damages = RoomDamage::with(['room', 'damageCategory', 'guestUser'])
            ->latest()
            ->paginate(10);
        return view('admin.room-damage.index', compact('damages'));
    }

    public function create()
    {
        $rooms = Room::where('room_status', 'Booked')->get();
        $categories = DamageCategory::all();
        $guestUsers = GuestUser::all();
        return view('admin.room-damage.create', compact('rooms', 'categories', 'guestUsers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_id' => 'required|exists:rooms,id',
            'damage_category_id' => 'required|exists:damage_categories,id',
            'guest_user_id' => 'required|exists:guest_users,id',
            'description' => 'required|string',
            'damage_cost' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        RoomDamage::create([
            'room_id' => $request->room_id,
            'damage_category_id' => $request->damage_category_id,
            'guest_user_id' => $request->guest_user_id,
            'description' => $request->description,
            'damage_cost' => $request->damage_cost,
            'payment_status' => 'Unpaid',
        ]);

        // Update room status to Maintenance
        $room = Room::find($request->room_id);
        $room->update(['room_status' => 'Maintenance']);

        return redirect()->route('admin.room-damages.index')
            ->with('success', 'Data kerusakan kamar berhasil ditambahkan.');
    }

    public function show($id)
    {
        $damage = RoomDamage::with(['room', 'damageCategory', 'guestUser', 'admin'])
            ->findOrFail($id);
        return view('admin.room-damage.show', compact('damage'));
    }

    public function edit($id)
    {
        $damage = RoomDamage::findOrFail($id);
        $rooms = Room::all();
        $categories = DamageCategory::all();
        $guestUsers = GuestUser::all();
        return view('admin.room-damage.edit', compact('damage', 'rooms', 'categories', 'guestUsers'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'room_id' => 'required|exists:rooms,id',
            'damage_category_id' => 'required|exists:damage_categories,id',
            'guest_user_id' => 'required|exists:guest_users,id',
            'description' => 'required|string',
            'damage_cost' => 'required|numeric|min:0',
            'payment_status' => 'required|in:Unpaid,Pending,Paid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $damage = RoomDamage::findOrFail($id);
        $damage->update([
            'room_id' => $request->room_id,
            'damage_category_id' => $request->damage_category_id,
            'guest_user_id' => $request->guest_user_id,
            'description' => $request->description,
            'damage_cost' => $request->damage_cost,
            'payment_status' => $request->payment_status,
        ]);

        return redirect()->route('admin.room-damages.index')
            ->with('success', 'Data kerusakan kamar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $damage = RoomDamage::findOrFail($id);
            if ($damage->payment_proof) {
                Storage::delete('public/damage-payments/' . $damage->payment_proof);
            }
            $damage->delete();
            return redirect()->route('admin.room-damages.index')
                ->with('success', 'Data kerusakan kamar berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.room-damages.index')
                ->with('error', 'Gagal menghapus data kerusakan kamar.');
        }
    }

    public function confirmPayment($id)
    {
        $damage = RoomDamage::findOrFail($id);
        
        if ($damage->payment_status !== 'Pending') {
            return redirect()->route('admin.room-damages.index')
                ->with('error', 'Status pembayaran bukan dalam status Pending.');
        }

        $damage->update([
            'payment_status' => 'Paid',
            'payment_confirmed_date' => now(),
            'confirmed_by' => Auth::id(),
        ]);

        // If room still in maintenance status, set it back to Available
        $room = Room::find($damage->room_id);
        if ($room->room_status === 'Maintenance') {
            $room->update(['room_status' => 'Available']);
        }

        return redirect()->route('admin.room-damages.index')
            ->with('success', 'Pembayaran kerusakan kamar berhasil dikonfirmasi.');
    }

    public function pendingPayments()
    {
        $damages = RoomDamage::with(['room', 'damageCategory', 'guestUser'])
            ->where('payment_status', 'Pending')
            ->latest()
            ->paginate(10);
        return view('admin.room-damage.pending-payments', compact('damages'));
    }
} 