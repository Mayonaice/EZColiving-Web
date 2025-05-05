@extends('layouts.admin')

@section('header', 'Detail Kamar')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.rooms.index') }}" class="text-green-600 hover:text-green-900">
            &larr; Kembali ke daftar kamar
        </a>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-between">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ $room->room_name }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Detail informasi kamar
                </p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.rooms.edit', $room) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 h-[32px] rounded-md">
                    Edit
                </a>
                <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kamar ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        <div class="border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                <div class="col-span-1">
                    @if($room->room_image1)
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Gambar Kamar</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            @if($room->room_image1)
                            <div>
                                <img src="{{ asset('storage/rooms/' . $room->room_image1) }}" alt="{{ $room->room_name }}" class="w-full h-48 object-cover rounded-lg">
                            </div>
                            @endif
                            
                            @if($room->room_image2)
                            <div>
                                <img src="{{ asset('storage/rooms/' . $room->room_image2) }}" alt="{{ $room->room_name }}" class="w-full h-48 object-cover rounded-lg">
                            </div>
                            @endif
                            
                            @if($room->room_image3)
                            <div>
                                <img src="{{ asset('storage/rooms/' . $room->room_image3) }}" alt="{{ $room->room_name }}" class="w-full h-48 object-cover rounded-lg">
                            </div>
                            @endif
                            
                            @if($room->room_image4)
                            <div>
                                <img src="{{ asset('storage/rooms/' . $room->room_image4) }}" alt="{{ $room->room_name }}" class="w-full h-48 object-cover rounded-lg">
                            </div>
                            @endif
                            
                            @if($room->room_image5)
                            <div>
                                <img src="{{ asset('storage/rooms/' . $room->room_image5) }}" alt="{{ $room->room_name }}" class="w-full h-48 object-cover rounded-lg">
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Nomor Kamar</h4>
                            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $room->room_number }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Tipe Kamar</h4>
                            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $room->room_type }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Harga</h4>
                            <p class="mt-1 text-lg font-semibold text-gray-900">Rp {{ number_format((int)$room->room_price, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Deposit</h4>
                            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $room->deposit_price ? 'Rp ' . number_format((int)$room->deposit_price, 0, ',', '.') : '-' }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Status</h4>
                            <p class="mt-1">
                                @php
                                    $statusClass = [
                                        'Available' => 'bg-green-100 text-green-800',
                                        'Booked' => 'bg-red-100 text-red-800',
                                        'Maintenance' => 'bg-yellow-100 text-yellow-800',
                                    ][$room->room_status];
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                    {{ $room->room_status }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500">Tanggal Dibuat</h4>
                            <p class="mt-1 text-sm text-gray-900">{{ $room->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-span-1">
                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-500">Deskripsi</h4>
                        <div class="mt-1 text-sm text-gray-900">
                            {!! nl2br(e($room->room_description)) !!}
                        </div>
                    </div>

                    @if($room->name_booking)
                    <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="text-sm font-medium text-blue-800">Informasi Booking</h4>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.rooms.edit-booking-info', $room) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 text-xs rounded">
                                    Edit Info Booking
                                </a>
                                <form action="{{ route('admin.rooms.reset-status', $room) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin mengosongkan kamar ini?');">
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 text-xs rounded">
                                        Kosongkan Kamar
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h5 class="text-xs font-medium text-gray-500">Nama Pemesan</h5>
                                <p class="text-sm text-gray-900">{{ $room->name_booking }}</p>
                            </div>
                            <div>
                                <h5 class="text-xs font-medium text-gray-500">Nomor Telepon</h5>
                                <p class="text-sm text-gray-900">{{ $room->phone_booking ?: '-' }}</p>
                            </div>
                            <div>
                                <h5 class="text-xs font-medium text-gray-500">Tanggal Pemesanan</h5>
                                <p class="text-sm text-gray-900">{{ $room->date_booking ? $room->date_booking->format('d M Y') : '-' }}</p>
                            </div>
                            <div>
                                <h5 class="text-xs font-medium text-gray-500">Tanggal Check-in</h5>
                                <p class="text-sm text-gray-900">{{ $room->date_booking_in ? $room->date_booking_in->format('d M Y') : '-' }}</p>
                            </div>
                            <div>
                                <h5 class="text-xs font-medium text-gray-500">Tanggal Check-out</h5>
                                <p class="text-sm text-gray-900">{{ $room->date_booking_out ? $room->date_booking_out->format('d M Y') : '-' }}</p>
                            </div>
                            <div>
                                <h5 class="text-xs font-medium text-gray-500">Status Check-in</h5>
                                <p class="text-sm flex items-center mt-1">
                                    @if($room->is_check_in == 'Y')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 mr-2">Sudah Check-in</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 mr-2">Belum Check-in</span>
                                    @endif
                                    <form action="{{ route('admin.rooms.toggle-status', $room) }}" method="POST" class="inline-block">
                                        @csrf
                                        <input type="hidden" name="field" value="is_check_in">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-2 py-1 rounded">
                                            {{ $room->is_check_in == 'Y' ? 'Batalkan' : 'Check-in' }}
                                        </button>
                                    </form>
                                </p>
                            </div>
                            <div>
                                <h5 class="text-xs font-medium text-gray-500">Status Check-out</h5>
                                <p class="text-sm flex items-center mt-1">
                                    @if($room->is_check_out == 'Y')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 mr-2">Sudah Check-out</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 mr-2">Belum Check-out</span>
                                    @endif
                                    <form action="{{ route('admin.rooms.toggle-status', $room) }}" method="POST" class="inline-block">
                                        @csrf
                                        <input type="hidden" name="field" value="is_check_out">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-2 py-1 rounded">
                                            {{ $room->is_check_out == 'Y' ? 'Batalkan' : 'Check-out' }}
                                        </button>
                                    </form>
                                </p>
                            </div>
                            <div>
                                <h5 class="text-xs font-medium text-gray-500">Status Deposit Masuk</h5>
                                <p class="text-sm flex items-center mt-1">
                                    @if($room->is_deposit_in == 'Y')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 mr-2">Deposit Dibayar</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 mr-2">Belum Dibayar</span>
                                    @endif
                                    <form action="{{ route('admin.rooms.toggle-status', $room) }}" method="POST" class="inline-block">
                                        @csrf
                                        <input type="hidden" name="field" value="is_deposit_in">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-2 py-1 rounded">
                                            {{ $room->is_deposit_in == 'Y' ? 'Batalkan' : 'Terima Deposit' }}
                                        </button>
                                    </form>
                                </p>
                            </div>
                            <div>
                                <h5 class="text-xs font-medium text-gray-500">Status Deposit Keluar</h5>
                                <p class="text-sm flex items-center mt-1">
                                    @if($room->is_deposit_out == 'Y')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 mr-2">Deposit Dikembalikan</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 mr-2">Belum Dikembalikan</span>
                                    @endif
                                    <form action="{{ route('admin.rooms.toggle-status', $room) }}" method="POST" class="inline-block">
                                        @csrf
                                        <input type="hidden" name="field" value="is_deposit_out">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-2 py-1 rounded">
                                            {{ $room->is_deposit_out == 'Y' ? 'Batalkan' : 'Kembalikan Deposit' }}
                                        </button>
                                    </form>
                                </p>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="text-sm font-medium text-gray-700">Kamar Tersedia</h4>
                            <a href="{{ route('admin.rooms.edit-booking-info', $room) }}" class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 text-xs rounded">
                                + Tambah Booking
                            </a>
                        </div>
                        <p class="text-sm text-gray-600">Kamar ini tersedia dan belum ada booking. Anda dapat menambahkan informasi booking secara manual.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection 