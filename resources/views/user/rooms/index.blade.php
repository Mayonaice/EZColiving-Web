@extends('user.layout')

@section('content')
<div class="container mx-auto px-4 py-8 mt-16 pl-12">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Daftar Kamar Tersedia</h1>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Filter Section -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <form action="{{ route('user.rooms.index') }}" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search Input -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Kamar</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="Nomor kamar atau tipe kamar...">
                </div>

                <!-- Room Type Filter -->
                <div>
                    <label for="room_type" class="block text-sm font-medium text-gray-700 mb-1">Tipe Kamar</label>
                    <select name="room_type" id="room_type" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Semua Tipe</option>
                        @foreach($roomTypes as $type)
                            <option value="{{ $type }}" {{ request('room_type') == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Price Range Filter -->
                <div>
                    <label for="price_range" class="block text-sm font-medium text-gray-700 mb-1">Range Harga</label>
                    <select name="price_range" id="price_range" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="2000000-3000000" {{ request('price_range') == '2000000-3000000' ? 'selected' : '' }}>
                            2 Juta - 3 Juta
                        </option>
                        <option value="3000000-4000000" {{ request('price_range') == '3000000-4000000' ? 'selected' : '' }}>
                            3 Juta - 4 Juta
                        </option>
                        <option value="4000000-5000000" {{ request('price_range') == '4000000-5000000' ? 'selected' : '' }}>
                            4 Juta - 5 Juta
                        </option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('user.rooms.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Reset
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($rooms as $room)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">Kamar {{ $room->room_number }}</h2>
                            <p class="text-gray-600">{{ $room->room_type }}</p>
                        </div>
                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $room->room_status === 'Available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $room->room_status }}
                        </span>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-2xl font-bold text-gray-800">
                            Rp {{ number_format($room->room_price, 0, ',', '.') }}<span class="text-sm font-normal text-gray-600">/bulan</span>
                        </p>
                    </div>

                    <div class="mb-4">
                        <p class="text-gray-600">{{ Str::limit($room->room_description, 100) }}</p>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('user.rooms.show', $room->id) }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500">Tidak ada kamar yang tersedia dengan filter yang dipilih.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection 