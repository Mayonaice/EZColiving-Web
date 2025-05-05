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
            'daily_price' => 'nullable|string',
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
            'daily_price' => 'nullable|string',
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

    /**
     * Reset status kamar menjadi Available dan menghapus informasi booking
     */
    public function resetRoomStatus(Room $room)
    {
        $room->update([
            'room_status' => 'Available',
            'name_booking' => '',
            'phone_booking' => '',
            'date_booking' => null,
            'date_booking_out' => null,
            'date_booking_in' => null,
            'is_check_in' => 'N',
            'is_check_out' => 'N',
            'is_deposit_in' => 'N',
            'is_deposit_out' => 'N'
        ]);

        return redirect()->route('admin.rooms.show', $room)
            ->with('success', 'Status kamar berhasil diubah menjadi Available!');
    }
    
    /**
     * Tampilkan form untuk mengubah informasi booking pada kamar
     */
    public function editBookingInfo(Room $room)
    {
        return view('admin.rooms.edit-booking-info', compact('room'));
    }
    
    /**
     * Update informasi booking pada kamar
     */
    public function updateBookingInfo(Request $request, Room $room)
    {
        // Jika status kamar diubah ke Available, tidak perlu validasi nama_booking
        if ($request->room_status === 'Available') {
            $request->validate([
                'room_status' => 'required|in:Available,Booked,Maintenance',
            ]);
            
            $room->update([
                'room_status' => 'Available',
                'name_booking' => '',
                'phone_booking' => '',
                'date_booking' => null,
                'date_booking_out' => null,
                'date_booking_in' => null,
                'is_check_in' => 'N',
                'is_check_out' => 'N',
                'is_deposit_in' => 'N',
                'is_deposit_out' => 'N'
            ]);
            
            return redirect()->route('admin.rooms.show', $room)
                ->with('success', 'Status kamar berhasil diubah menjadi Available dan informasi booking dihapus!');
        }
        
        // Jika status bukan Available, maka validasi data booking
        $request->validate([
            'name_booking' => 'required|string|max:255',
            'phone_booking' => 'nullable|string|max:20',
            'date_booking' => 'nullable|date',
            'date_booking_in' => 'nullable|date',
            'date_booking_out' => 'nullable|date',
            'is_check_in' => 'required|in:Y,N',
            'is_check_out' => 'required|in:Y,N',
            'is_deposit_in' => 'required|in:Y,N',
            'is_deposit_out' => 'required|in:Y,N',
            'room_status' => 'required|in:Available,Booked,Maintenance',
            'master_payment_id' => 'required|exists:master_payments,id',
            'total_price' => 'required|numeric|min:0',
            'rental_type' => 'required|in:daily,monthly',
            'rental_duration' => 'required|integer|min:1',
        ]);

        // Pastikan nilai phone_booking tidak NULL
        $data = $request->all();
        $data['phone_booking'] = $request->phone_booking ?: '';
        
        // Jika tipe pemesanan adalah bulanan, pastikan is_deposit_in diupdate
        if ($request->rental_type === 'monthly') {
            $data['is_deposit_in'] = 'Y'; // Otomatis set deposit masuk untuk sewa bulanan
        }
        
        // Update informasi kamar dengan data baru
        $room->update($data);

        // Buat atau perbarui data di tabel payment dan booking jika status Booked
        if ($request->room_status === 'Booked') {
            // Cari guest user atau buat baru jika tidak ada
            $guestUser = $this->getOrCreateGuestUser($request->name_booking, $request->phone_booking);
            
            // Buat data payment
            $payment = $this->createOrUpdatePayment($request, $room);
            
            // Buat data booking
            $this->createOrUpdateBooking($request, $room, $guestUser, $payment);
        }

        return redirect()->route('admin.rooms.show', $room)
            ->with('success', 'Informasi booking berhasil diperbarui!');
    }

    /**
     * Membuat atau mendapatkan guest user
     */
    private function getOrCreateGuestUser($name, $phone)
    {
        // Generate device_name unik untuk guest user
        $deviceName = 'admin_created_' . md5($name . $phone . time());
        
        // Cek apakah guest user dengan nama dan nomor hp yang sama sudah ada
        $guestUser = \App\Models\GuestUser::where('name', $name)
            ->where('phone', $phone)
            ->first();
            
        if (!$guestUser) {
            // Buat guest user baru
            $guestUser = \App\Models\GuestUser::create([
                'name' => $name,
                'phone' => $phone,
                'device_name' => $deviceName,
                'device_info' => json_encode(['source' => 'admin_created']),
                'last_activity' => now(),
                'cart_data' => json_encode([]),
                'booking_history' => json_encode([])
            ]);
        }
        
        return $guestUser;
    }

    /**
     * Membuat atau memperbarui data payment
     */
    private function createOrUpdatePayment($request, $room)
    {
        // Dapatkan data master payment
        $masterPayment = \App\Models\MasterPayment::findOrFail($request->master_payment_id);
        
        // Cek apakah sudah ada payment untuk room ini
        $existingPayment = \App\Models\Payment::whereHas('booking', function($query) use ($room) {
            $query->where('room_id', $room->id)
                ->where('booking_status', 'Confirmed');
        })->first();
        
        if ($existingPayment) {
            // Update payment yang sudah ada
            $existingPayment->update([
                'master_payment_id' => $masterPayment->id,
                'payment_name' => $masterPayment->payment_name,
                'payment_number' => $masterPayment->payment_account_number,
                'payment_amount' => $request->total_price,
                'payment_status' => 'Confirmed'
            ]);
            
            return $existingPayment;
        } else {
            // Buat payment baru
            $payment = \App\Models\Payment::create([
                'master_payment_id' => $masterPayment->id,
                'payment_name' => $masterPayment->payment_name,
                'payment_number' => $masterPayment->payment_account_number,
                'payment_amount' => $request->total_price,
                'payment_status' => 'Confirmed'
            ]);
            
            return $payment;
        }
    }

    /**
     * Membuat atau memperbarui data booking
     */
    private function createOrUpdateBooking($request, $room, $guestUser, $payment)
    {
        // Format tanggal
        $bookingDateIn = $request->date_booking_in ? \Carbon\Carbon::parse($request->date_booking_in) : now();
        $bookingDateOut = $request->date_booking_out ? \Carbon\Carbon::parse($request->date_booking_out) : $bookingDateIn->copy()->addDays(30);
        $bookingDate = $request->date_booking ? \Carbon\Carbon::parse($request->date_booking) : now();
        
        // Cek apakah sudah ada booking untuk room ini
        $existingBooking = \App\Models\Booking::where('room_id', $room->id)
            ->where('booking_status', 'Confirmed')
            ->first();
            
        // Data booking
        $bookingData = [
            'room_id' => $room->id,
            'guest_user_id' => $guestUser->id,
            'payment_id' => $payment->id,
            'name_booking' => $request->name_booking,
            'phone_booking' => $request->phone_booking ?: '',
            'email_booking' => null, // Email tidak tersedia dari form admin
            'booking_number' => 'BK-ADM-' . time() . rand(1000, 9999),
            'rental_type' => $request->rental_type,
            'rental_duration' => $request->rental_duration,
            'total_price' => $request->total_price,
            'booking_date' => $bookingDate,
            'booking_date_in' => $bookingDateIn,
            'booking_date_out' => $bookingDateOut,
            'booking_status' => 'Confirmed'
        ];
        
        if ($existingBooking) {
            // Jika nomor booking sudah ada, pertahankan
            unset($bookingData['booking_number']);
            $existingBooking->update($bookingData);
            return $existingBooking;
        } else {
            // Buat booking baru
            $booking = \App\Models\Booking::create($bookingData);
            return $booking;
        }
    }

    /**
     * Toggle status fields (is_check_in, is_check_out, is_deposit_in, is_deposit_out)
     */
    public function toggleStatus(Request $request, Room $room)
    {
        $field = $request->field;
        $allowedFields = ['is_check_in', 'is_check_out', 'is_deposit_in', 'is_deposit_out'];
        
        if (!in_array($field, $allowedFields)) {
            return redirect()->back()->with('error', 'Field tidak valid');
        }
        
        // Toggle nilai Y/N
        $currentValue = $room->{$field};
        $newValue = $currentValue === 'Y' ? 'N' : 'Y';
        
        $updates = [$field => $newValue];
        
        // Logika untuk update status terkait
        if ($field === 'is_check_in') {
            if ($newValue === 'Y') {
                $updates['is_check_out'] = 'N'; // Reset check-out jika check-in
            }
        } elseif ($field === 'is_check_out') {
            if ($newValue === 'Y') {
                $updates['is_check_in'] = 'N'; // Reset check-in jika check-out
            }
        } elseif ($field === 'is_deposit_in') {
            if ($newValue === 'Y') {
                $updates['is_deposit_out'] = 'N'; // Reset deposit out jika deposit in
            }
        } elseif ($field === 'is_deposit_out') {
            if ($newValue === 'Y') {
                $updates['is_deposit_in'] = 'N'; // Reset deposit in jika deposit out
            }
        }
        
        $room->update($updates);
        
        $statusLabels = [
            'is_check_in' => 'Status Check-in',
            'is_check_out' => 'Status Check-out',
            'is_deposit_in' => 'Status Deposit Masuk',
            'is_deposit_out' => 'Status Deposit Keluar'
        ];
        
        $valueLabels = [
            'Y' => 'Ya',
            'N' => 'Tidak'
        ];
        
        return redirect()->back()->with('success', "{$statusLabels[$field]} berhasil diubah menjadi {$valueLabels[$newValue]}");
    }
} 