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
                        <h4 class="text-sm font-medium text-blue-800 mb-2">Informasi Booking</h4>
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
                                <p class="text-sm">
                                    @if($room->is_check_in == 'Y')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Sudah Check-in</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Belum Check-in</span>
                                    @endif
                                </p>
                            </div>
                            <div>
                                <h5 class="text-xs font-medium text-gray-500">Status Check-out</h5>
                                <p class="text-sm">
                                    @if($room->is_check_out == 'Y')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Sudah Check-out</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Belum Check-out</span>
                                    @endif
                                </p>
                            </div>
                            <div>
                                <h5 class="text-xs font-medium text-gray-500">Status Deposit</h5>
                                <p class="text-sm">
                                    @if($room->is_deposit_in == 'Y')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Deposit Dibayar</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Belum Dibayar</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection 