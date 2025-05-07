@extends('user.layout')

@section('content')
<div class="container mx-auto px-4 py-8 mt-14 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-1 bg-green-600 rounded-full"></div>
                <h1 class="text-3xl font-bold text-gray-800">Daftar Kamar Tersedia</h1>
            </div>
            <button id="switchFilterBtn" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-150 ease-in-out shadow-md flex items-center font-medium text-sm">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
                <span id="filterTypeText">Filter Denah</span>
            </button>
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
        <div id="filterSection" class="bg-white p-5 rounded-lg shadow-md mb-8 border border-gray-100">
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

        <div id="denahView" class="bg-white p-5 rounded-lg shadow-md mb-8 border border-gray-100 hidden">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Denah Kamar Ez Coliving
                </h2>
                <button id="closeDenahBtn" class="text-gray-600 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="bg-gray-100 rounded-lg p-4">
                <!-- Pemilihan Lantai -->
                <div class="flex space-x-4 mb-6">
                    <button class="floor-btn w-12 h-12 rounded-lg bg-green-600 text-white font-semibold active"
                        data-floor="1"></button>
                    <button class="floor-btn w-12 h-12 rounded-lg bg-gray-200 text-gray-700 font-semibold" data-floor="2"></button>
                    <button class="floor-btn w-12 h-12 rounded-lg bg-gray-200 text-gray-700 font-semibold" data-floor="3"></button>
                    <button class="floor-btn w-12 h-12 rounded-lg bg-gray-200 text-gray-700 font-semibold" data-floor="4"></button>
                </div>

                <!-- Denah Container -->
                <div class="relative w-full border-2 border-gray-300 rounded-lg overflow-hidden bg-gray-800" style="height: 700px;">
                    <div class="absolute left-0 top-0 bottom-0 w-12 flex items-center justify-center">
                        <h2 class="text-6xl font-bold text-white transform -rotate-0"></h2>
                    </div>

                    <!-- Floor 1 -->
                    <div class="floor-content active" data-floor="1">
                        <div class="absolute inset-0 p-4">
                            <div class="relative mx-auto h-full">
                                <!-- Container khusus untuk floor 1 -->
                                <div class="absolute inset-0">
                                    <!-- Lorong -->
                                    <div class="absolute bg-gray-700 text-center py-2 text-white font-medium"
                                        style="top: 42%; left: 2%; width: 96%; height: 16%;">
                                        Lorong
                                    </div>

                                    <!-- Kamar Atas Lantai 1 -->
                                    <div class="absolute flex flex-wrap" style="top: 20.5%; left: 2%; width: 96%; height: 38%;">
                                        <div class="bg-gray-400 rounded-lg flex items-center justify-center p-2 w-[74px] h-[135px] mr-4">
                                            <span class="text-white text-base text-center">Rak paket</span>
                                        </div>
                                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                            data-room="1BE">
                                            <span class="font-bold text-lg">1BE</span>
                                            <span class="text-sm mt-1">(Superior)</span>
                                        </div>
                                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                            data-room="1BD">
                                            <span class="font-bold text-lg">1BD</span>
                                            <span class="text-sm mt-1">(Superior)</span>
                                        </div>
                                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                            data-room="1BC">
                                            <span class="font-bold text-lg">1BC</span>
                                            <span class="text-sm mt-1">(Superior)</span>
                                        </div>
                                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                            data-room="1BB">
                                            <span class="font-bold text-lg">1BB</span>
                                            <span class="text-sm mt-1">(Superior)</span>
                                        </div>
                                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                            data-room="1BA">
                                            <span class="font-bold text-lg">1BA</span>
                                            <span class="text-sm mt-1">(Superior)</span>
                                        </div>
                                    </div>

                                    <!-- Kamar Bawah Lantai 1 -->
                                    <div class="absolute flex flex-wrap" style="bottom: 2%; left: 2%; width: 96%; height: 38%;">
                                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[148px] h-[135px] mr-4">
                                            <span class="font-bold text-base text-center">Kamar Manager</span>
                                        </div>
                                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                            data-room="1AC">
                                            <span class="font-bold text-lg">1AC</span>
                                            <span class="text-sm mt-1">(Superior)</span>
                                        </div>
                                        <div class="bg-gray-400 rounded-lg flex items-center justify-center p-2 w-[112px] h-[135px] mr-4">
                                            <span class="text-white text-base">Gudang</span>
                                        </div>
                                        <div class="bg-gray-400 rounded-lg flex items-center justify-center p-2 w-[92px] h-[135px] mr-4">
                                            <span class="text-white text-base">Stair</span>
                                        </div>
                                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[160px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                            data-room="1AB">
                                            <span class="font-bold text-lg">1AB</span>
                                            <span class="text-sm mt-1">(Deluxe)</span>
                                        </div>
                                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[160px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                            data-room="1AA">
                                            <span class="font-bold text-lg">1AA</span>
                                            <span class="text-sm mt-1">(Deluxe)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Floor 2 -->
                    <div class="floor-content hidden" data-floor="2">
                        <div class="absolute inset-0 p-4">
                            <!-- Lorong -->
                            <div class="absolute bg-gray-700 text-center py-2 text-white font-medium"
                                style="top: 42%; left: 2%; width: 96%; height: 16%;">
                                Lorong
                            </div>

                            <!-- Kamar Atas Lantai 2 -->
                            <div class="absolute flex flex-wrap" style="top: 20.5%; left: 2%; width: 96%; height: 38%;">
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="2BF">
                                    <span class="font-bold text-lg">2BF</span>
                                    <span class="text-sm mt-1">(Superior)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="2BE">
                                    <span class="font-bold text-lg">2BE</span>
                                    <span class="text-sm mt-1">(Superior)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="2BD">
                                    <span class="font-bold text-lg">2BD</span>
                                    <span class="text-sm mt-1">(Superior)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="2BC">
                                    <span class="font-bold text-lg">2BC</span>
                                    <span class="text-sm mt-1">(Superior)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="2BB">
                                    <span class="font-bold text-lg">2BB</span>
                                    <span class="text-sm mt-1">(Superior)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[186px] h-[135px] hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="2BA">
                                    <span class="font-bold text-lg">2BA</span>
                                    <span class="text-sm mt-1">(Suite)</span>
                                </div>
                            </div>

                            <!-- Kamar Bawah Lantai 2 -->
                            <div class="absolute flex flex-wrap" style="bottom: 2%; left: 2%; width: 96%; height: 38%;">
                                <div class="bg-gray-400 col-span-2 rounded-lg flex items-center justify-center p-2 w-[380px] h-[135px] mr-4">
                                    <span class="text-white text-base">Pantry</span>
                                </div>
                                <div class="bg-gray-400 rounded-lg flex items-center justify-center p-2 w-[92px] h-[135px] mr-4">
                                    <span class="text-white text-base">Stair</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[160px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="2AC">
                                    <span class="font-bold text-lg">2AC</span>
                                    <span class="text-sm mt-1">(Deluxe)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[160px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="2AB">
                                    <span class="font-bold text-lg">2AB</span>
                                    <span class="text-sm mt-1">(Deluxe)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[186px] h-[135px] hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="2AA">
                                    <span class="font-bold text-lg">2AA</span>
                                    <span class="text-sm mt-1">(Suite)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Floor 3 -->
                    <div class="floor-content hidden" data-floor="3">
                        <div class="absolute inset-0 p-4">
                            <!-- Lorong -->
                            <div class="absolute bg-gray-700 text-center py-2 text-white font-medium"
                                style="top: 42%; left: 2%; width: 96%; height: 16%;">
                                Lorong
                            </div>

                            <!-- Kamar Atas Lantai 3 -->
                            <div class="absolute flex flex-wrap" style="top: 20.5%; left: 2%; width: 96%; height: 38%;">
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="3BF">
                                    <span class="font-bold text-lg">3BF</span>
                                    <span class="text-sm mt-1">(Superior)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="3BE">
                                    <span class="font-bold text-lg">3BE</span>
                                    <span class="text-sm mt-1">(Superior)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="3BD">
                                    <span class="font-bold text-lg">3BD</span>
                                    <span class="text-sm mt-1">(Superior)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="3BC">
                                    <span class="font-bold text-lg">3BC</span>
                                    <span class="text-sm mt-1">(Superior)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="3BB">
                                    <span class="font-bold text-lg">3BB</span>
                                    <span class="text-sm mt-1">(Superior)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[186px] h-[135px] hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="3BA">
                                    <span class="font-bold text-lg">3BA</span>
                                    <span class="text-sm mt-1">(Suite)</span>
                                </div>
                            </div>

                            <!-- Kamar Bawah Lantai 3 -->
                            <div class="absolute flex flex-wrap" style="bottom: 2%; left: 2%; width: 96%; height: 38%;">
                                <div class="bg-gray-400 col-span-2 rounded-lg flex items-center justify-center p-2 w-[380px] h-[135px] mr-4">
                                    <span class="text-white text-base">Pantry</span>
                                </div>
                                <div class="bg-gray-400 rounded-lg flex items-center justify-center p-2 w-[92px] h-[135px] mr-4">
                                    <span class="text-white text-base">Stair</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[160px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="3AC">
                                    <span class="font-bold text-lg">3AC</span>
                                    <span class="text-sm mt-1">(Deluxe)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[160px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="3AB">
                                    <span class="font-bold text-lg">3AB</span>
                                    <span class="text-sm mt-1">(Deluxe)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[186px] h-[135px] hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="3AA">
                                    <span class="font-bold text-lg">3AA</span>
                                    <span class="text-sm mt-1">(Suite)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Floor 4 -->
                    <div class="floor-content hidden" data-floor="4">
                        <div class="absolute inset-0 p-4">
                            <!-- Lorong -->
                            <div class="absolute bg-gray-700 text-center py-2 text-white font-medium"
                                style="top: 42%; left: 2%; width: 96%; height: 16%;">
                                Lorong
                            </div>

                            <!-- Kamar Atas Lantai 4 -->
                            <div class="absolute flex flex-wrap" style="top: 20.5%; left: 2%; width: 96%; height: 38%;">
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="4BF">
                                    <span class="font-bold text-lg">4BF</span>
                                    <span class="text-sm mt-1">(Superior)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="4BE">
                                    <span class="font-bold text-lg">4BE</span>
                                    <span class="text-sm mt-1">(Superior)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="4BD">
                                    <span class="font-bold text-lg">4BD</span>
                                    <span class="text-sm mt-1">(Superior)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="4BC">
                                    <span class="font-bold text-lg">4BC</span>
                                    <span class="text-sm mt-1">(Superior)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[150px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="4BB">
                                    <span class="font-bold text-lg">4BB</span>
                                    <span class="text-sm mt-1">(Superior)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[186px] h-[135px] hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="4BA">
                                    <span class="font-bold text-lg">4BA</span>
                                    <span class="text-sm mt-1">(Suite)</span>
                                </div>
                            </div>

                            <!-- Kamar Bawah Lantai 4 -->
                            <div class="absolute flex flex-wrap" style="bottom: 2%; left: 2%; width: 96%; height: 38%;">
                                <div class="bg-gray-400 col-span-2 rounded-lg flex items-center justify-center p-2 w-[380px] h-[135px] mr-4">
                                    <span class="text-white text-base">Pantry</span>
                                </div>
                                <div class="bg-gray-400 rounded-lg flex items-center justify-center p-2 w-[92px] h-[135px] mr-4">
                                    <span class="text-white text-base">Stair</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[160px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="4AC">
                                    <span class="font-bold text-lg">4AC</span>
                                    <span class="text-sm mt-1">(Deluxe)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[160px] h-[135px] mr-4 hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="4AB">
                                    <span class="font-bold text-lg">4AB</span>
                                    <span class="text-sm mt-1">(Deluxe)</span>
                                </div>
                                <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer w-[186px] h-[135px] hover:bg-green-50 hover:border-green-500 transition-all duration-200"
                                    data-room="4AA">
                                    <span class="font-bold text-lg">4AA</span>
                                    <span class="text-sm mt-1">(Suite)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="noRoomMessage" class="hidden text-center text-gray-500 text-base mb-8">Kamar Tidak Tersedia</div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($rooms as $room)
                <div class="room-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1"
                    data-room-id="{{ $room->id }}"
                    data-room-number="{{ $room->room_number }}"
                    data-room-type="{{ $room->room_type }}"
                    data-room-price="{{ number_format($room->room_price, 0, ',', '.') }}"
                    data-room-status="{{ $room->room_status }}"
                    data-room-description="{{ $room->room_description }}"
                    data-room-facilities="{{ json_encode($room->facilities ?? []) }}">
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

<!-- Detail Kamar Section -->
<div id="roomDetailSection" class="mt-8 bg-white rounded-lg shadow-md p-6 hidden">
    <!-- Foto Kamar (Slider/Gambar utama) -->
    <div class="mb-6">
        <div id="detailRoomImages" class="relative w-full h-64 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
            <img id="detailRoomMainImage" src="" alt="Foto Kamar" class="object-cover w-full h-full rounded-lg shadow-md transition-all duration-300" style="display:none;">
            <div id="detailRoomNoImage" class="flex flex-col items-center justify-center text-gray-400" style="display:none;">
                <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a4 4 0 004 4h10a4 4 0 004-4V7a4 4 0 00-4-4H7a4 4 0 00-4 4z" />
                </svg>
                <span class="text-base">Tidak ada foto kamar</span>
            </div>
            <button id="prevImageBtn" class="absolute left-2 top-1/2 -translate-y-1/2 bg-white bg-opacity-80 rounded-full p-2 shadow hover:bg-green-100 transition hidden">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </button>
            <button id="nextImageBtn" class="absolute right-2 top-1/2 -translate-y-1/2 bg-white bg-opacity-80 rounded-full p-2 shadow hover:bg-green-100 transition hidden">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
        </div>
        <div id="detailRoomThumbnails" class="flex space-x-2 mt-3 justify-center"></div>
    </div>
    <!-- End Foto Kamar -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-6 gap-6">
        <div>
            <h3 class="text-3xl font-bold text-gray-800 mb-1 flex items-center" id="detailRoomNumber">Kamar -</h3>
            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 mb-2" id="detailRoomType">Tipe Kamar -</span>
            <div class="flex items-center space-x-2 mb-2">
                <span id="detailRoomStatus" class="px-3 py-1 rounded-full text-xs font-semibold"></span>
                <span class="text-gray-500 text-xs" id="detailRoomLocation">-</span>
            </div>
        </div>
        <div class="flex flex-col items-end">
            <div class="text-2xl font-extrabold text-green-700 mb-1" id="detailRoomPrice">-</div>
            <div class="text-xs text-gray-500">/bulan</div>
        </div>
    </div>
    <div class="mb-6">
        <h4 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi Kamar</h4>
        <p class="text-gray-600 text-sm" id="detailRoomDescription">-</p>
    </div>
    <div class="mb-6">
        <h4 class="text-lg font-semibold text-gray-800 mb-2">Fasilitas Kamar</h4>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3" id="detailRoomFacilities">
            <!-- Fasilitas akan diisi melalui JavaScript -->
        </div>
    </div>
    <div class="mt-8 flex justify-end space-x-4">
        <button id="closeDetailBtn" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-150">
            Tutup
        </button>
        <a id="bookRoomBtn" href="#" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-150 hidden">
            Pesan Kamar
        </a>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const switchFilterBtn = document.getElementById('switchFilterBtn');
    const filterTypeText = document.getElementById('filterTypeText');
    const denahView = document.getElementById('denahView');
    const filterSection = document.getElementById('filterSection');
    const closeDenahBtn = document.getElementById('closeDenahBtn');
    const floorBtns = document.querySelectorAll('.floor-btn');
    const floorContents = document.querySelectorAll('.floor-content');
    const roomItems = document.querySelectorAll('.room-item');
    const roomCards = document.querySelectorAll('.room-card');
    let isDenahView = false;
    let selectedRoom = null;

    // Switch filter view
    switchFilterBtn.addEventListener('click', function() {
        // Reset filter input
        document.getElementById('search').value = '';
        document.getElementById('room_type').selectedIndex = 0;
        document.getElementById('price_range').selectedIndex = 0;
        // Tampilkan semua kamar
        roomCards.forEach(card => {
            card.classList.remove('hidden');
        });
        // Sembunyikan pesan tidak ada kamar
        document.getElementById('noRoomMessage').classList.add('hidden');
        isDenahView = !isDenahView;
        if (isDenahView) {
            filterTypeText.textContent = 'Filter Normal';
            denahView.classList.remove('hidden');
            filterSection.classList.add('hidden');
            // Reset room selection
            selectedRoom = null;
            roomItems.forEach(item => {
                item.classList.remove('bg-green-50', 'border-green-500');
                item.classList.add('bg-gray-100', 'border-gray-300');
            });
        } else {
            filterTypeText.textContent = 'Filter Denah';
            denahView.classList.add('hidden');
            filterSection.classList.remove('hidden');
            document.getElementById('noRoomMessage').classList.add('hidden');
        }
    });

    // Close denah view
    closeDenahBtn.addEventListener('click', function() {
        isDenahView = false;
        filterTypeText.textContent = 'Filter Denah';
        denahView.classList.add('hidden');
        filterSection.classList.remove('hidden');
        document.getElementById('noRoomMessage').classList.add('hidden');
    });

    // Floor selection
    floorBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const floor = this.dataset.floor;
            
            // Update button styles
            floorBtns.forEach(b => {
                b.classList.remove('bg-green-600', 'text-white');
                b.classList.add('bg-gray-200', 'text-gray-700');
            });
            this.classList.remove('bg-gray-200', 'text-gray-700');
            this.classList.add('bg-green-600', 'text-white');
            
            // Show selected floor content
            floorContents.forEach(content => {
                content.classList.add('hidden');
                if (content.dataset.floor === floor) {
                    content.classList.remove('hidden');
                }
            });
        });
    });

    // Room item click
    roomItems.forEach(item => {
        item.addEventListener('click', function() {
            const roomNumber = this.dataset.room;
            
            // Update room item styles
            roomItems.forEach(room => {
                room.classList.remove('bg-green-50', 'border-green-500');
                room.classList.add('bg-gray-100', 'border-gray-300');
            });
            this.classList.remove('bg-gray-100', 'border-gray-300');
            this.classList.add('bg-green-50', 'border-green-500');
            
            // Filter room cards
            let found = false;
            roomCards.forEach(card => {
                const cardRoomNumber = card.dataset.roomNumber;
                if (cardRoomNumber === roomNumber) {
                    card.classList.remove('hidden');
                    card.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    found = true;
                } else {
                    card.classList.add('hidden');
                }
            });
            
            // Tampilkan pesan jika tidak ada kamar
            document.getElementById('noRoomMessage').classList.toggle('hidden', found);
            selectedRoom = roomNumber;

            // Find room data from room cards
            const roomCard = Array.from(roomCards).find(card => card.dataset.roomNumber === roomNumber);
            if (roomCard) {
                // Foto Kamar
                const images = [];
                if (roomCard.dataset.roomImage1) images.push(roomCard.dataset.roomImage1);
                if (roomCard.dataset.roomImage2) images.push(roomCard.dataset.roomImage2);
                if (roomCard.dataset.roomImage3) images.push(roomCard.dataset.roomImage3);
                let currentImage = 0;
                const mainImage = document.getElementById('detailRoomMainImage');
                const noImage = document.getElementById('detailRoomNoImage');
                const thumbnails = document.getElementById('detailRoomThumbnails');
                const prevBtn = document.getElementById('prevImageBtn');
                const nextBtn = document.getElementById('nextImageBtn');
                if (images.length > 0) {
                    mainImage.src = images[0];
                    mainImage.style.display = '';
                    noImage.style.display = 'none';
                    thumbnails.innerHTML = '';
                    images.forEach((img, idx) => {
                        const thumb = document.createElement('img');
                        thumb.src = img;
                        thumb.className = 'w-16 h-12 object-cover rounded cursor-pointer border-2 ' + (idx === 0 ? 'border-green-600' : 'border-transparent');
                        thumb.addEventListener('click', () => {
                            currentImage = idx;
                            mainImage.src = images[currentImage];
                            Array.from(thumbnails.children).forEach((el, i) => {
                                el.className = 'w-16 h-12 object-cover rounded cursor-pointer border-2 ' + (i === currentImage ? 'border-green-600' : 'border-transparent');
                            });
                        });
                        thumbnails.appendChild(thumb);
                    });
                    prevBtn.style.display = images.length > 1 ? '' : 'none';
                    nextBtn.style.display = images.length > 1 ? '' : 'none';
                    prevBtn.onclick = function() {
                        currentImage = (currentImage - 1 + images.length) % images.length;
                        mainImage.src = images[currentImage];
                        Array.from(thumbnails.children).forEach((el, i) => {
                            el.className = 'w-16 h-12 object-cover rounded cursor-pointer border-2 ' + (i === currentImage ? 'border-green-600' : 'border-transparent');
                        });
                    };
                    nextBtn.onclick = function() {
                        currentImage = (currentImage + 1) % images.length;
                        mainImage.src = images[currentImage];
                        Array.from(thumbnails.children).forEach((el, i) => {
                            el.className = 'w-16 h-12 object-cover rounded cursor-pointer border-2 ' + (i === currentImage ? 'border-green-600' : 'border-transparent');
                        });
                    };
                } else {
                    mainImage.style.display = 'none';
                    noImage.style.display = '';
                    thumbnails.innerHTML = '';
                    prevBtn.style.display = 'none';
                    nextBtn.style.display = 'none';
                }
                // ... existing code detail kamar ...
            }
        });
    });
});
</script>
@endpush

@endsection 