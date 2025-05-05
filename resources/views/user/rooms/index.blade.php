@extends('user.layout')

@section('content')
<div class="container mx-auto px-4 py-8 mt-14 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center space-x-2 mb-8">
            <div class="w-8 h-1 bg-green-600 rounded-full"></div>
            <h1 class="text-3xl font-bold text-gray-800">Daftar Kamar Tersedia</h1>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded-lg shadow-sm mb-6 flex items-center" role="alert">
                <svg class="h-5 w-5 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span class="block sm:inline font-medium text-sm">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Filter Section -->
        <div class="bg-white p-5 rounded-lg shadow-md mb-8 border border-gray-100">
            <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                Filter Pencarian
            </h2>
            <form action="{{ route('user.rooms.index') }}" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Search Input -->
                    <div class="relative">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Kamar</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                class="pl-8 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-150 ease-in-out text-sm"
                                placeholder="Nomor kamar atau tipe kamar...">
                        </div>
                    </div>

                    <!-- Room Type Filter -->
                    <div>
                        <label for="room_type" class="block text-sm font-medium text-gray-700 mb-1">Tipe Kamar</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <select name="room_type" id="room_type" 
                                class="pl-8 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-150 ease-in-out appearance-none bg-none text-sm">
                                <option value="">Semua Tipe</option>
                                @foreach($roomTypes as $type)
                                    <option value="{{ $type }}" {{ request('room_type') == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Price Range Filter -->
                    <div>
                        <label for="price_range" class="block text-sm font-medium text-gray-700 mb-1">Range Harga</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <select name="price_range" id="price_range" 
                                class="pl-8 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-150 ease-in-out appearance-none text-sm">
                                <option value="">Semua Harga</option>
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
                            <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-2">
                    <a href="{{ route('user.rooms.index') }}" 
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-all duration-150 ease-in-out shadow-sm flex items-center text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Reset
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-150 ease-in-out shadow-md flex items-center font-medium text-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($rooms as $room)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <!-- Room Image -->
                    <div class="h-40 relative overflow-hidden">
                        @if($room->room_image1)
                            <img src="{{ asset('storage/rooms/' . $room->room_image1) }}" alt="{{ $room->room_name }}" class="w-full h-full object-cover">
                        @else
                            <div class="h-full bg-gradient-to-r from-green-400 to-green-600 flex items-center justify-center">
                                <div class="text-white text-center p-6">
                                    <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    <h3 class="text-base font-medium">{{ $room->room_type }}</h3>
                                </div>
                            </div>
                        @endif
                        <div class="absolute top-2 right-2">
                            <span class="inline-block px-2 py-1 text-xs font-bold rounded-full {{ $room->room_status === 'Available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} shadow-sm">
                                {{ $room->room_status }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h2 class="text-lg font-bold text-gray-800 mb-1">Kamar {{ $room->room_number }}</h2>
                                <div class="flex items-center text-gray-600 text-xs">
                                    <svg class="w-3 h-3 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    {{ $room->room_type }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="flex items-center mb-1">
                                <div class="text-xl font-bold text-gray-800">
                                    Rp {{ number_format($room->room_price, 0, ',', '.') }}
                                </div>
                                <div class="ml-1 text-xs font-medium text-gray-500">/bulan</div>
                            </div>
                            @if($room->daily_price)
                                <div class="text-xs text-gray-600">
                                    <span class="font-semibold">Harian:</span> Rp {{ number_format($room->daily_price, 0, ',', '.') }}/hari
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <p class="text-gray-600 text-xs">{{ Str::limit($room->room_description, 80) }}</p>
                        </div>

                        <div class="flex items-center space-x-2">
                            <a href="{{ route('user.rooms.show', $room->id) }}" class="w-full inline-block bg-green-600 text-white px-3 py-2 rounded-lg hover:bg-green-700 transition-all text-center font-medium shadow-sm hover:shadow-md text-sm">
                                <span class="flex items-center justify-center">
                                    <span>Lihat Detail</span>
                                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-6">
                    <div class="text-center max-w-sm mx-auto">
                        <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <p class="text-gray-500 text-base">Mohon maaf, tidak ada kamar yang tersedia dengan filter yang dipilih.</p>
                        <a href="{{ route('user.rooms.index') }}" class="mt-3 inline-block text-green-600 hover:text-green-800 font-medium text-sm">
                            Reset filter pencarian
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection 