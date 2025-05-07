@extends('layouts.admin')

@section('header', 'Kelola Kamar')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Daftar Kamar</h1>
        <a href="{{ route('admin.rooms.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">
            Tambah Kamar Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nama Kamar
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nomor Kamar
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tipe
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Harga
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($rooms as $room)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    @if ($room->room_image1)
                                        <img class="h-10 w-10 rounded-full object-cover" 
                                             src="{{ asset('storage/rooms/' . $room->room_image1) }}" 
                                             alt="{{ $room->room_name }}">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-500">No img</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $room->room_name }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $room->room_number }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $room->room_type }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Rp {{ number_format((int)$room->room_price, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
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
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.rooms.show', $room) }}" class="text-blue-600 hover:text-blue-900">
                                    Detail
                                </a>
                                <a href="{{ route('admin.rooms.edit', $room) }}" class="text-yellow-600 hover:text-yellow-900">
                                    Edit
                                </a>
                                <button type="button" 
                                        onclick="openModal('delete-room-{{ $room->id }}')"
                                        class="text-red-600 hover:text-red-900">
                                    Hapus
                                </button>
                            </div>

                            <x-confirmation-modal id="delete-room-{{ $room->id }}"
                                                 title="Hapus Kamar"
                                                 message="Apakah Anda yakin ingin menghapus kamar ini? Tindakan ini tidak dapat dibatalkan.">
                                <form id="form-delete-room-{{ $room->id }}" action="{{ route('admin.rooms.destroy', $room) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </x-confirmation-modal>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="text-sm text-gray-500">Belum ada data kamar</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $rooms->links() }}
    </div>
@endsection 