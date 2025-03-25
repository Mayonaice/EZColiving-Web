@extends('user.layout')

@section('content')
<div class="container mx-auto px-4 py-8 mt-24 pl-12">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-8">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Kamar {{ $room->room_number }}</h1>
                        <p class="text-xl text-gray-600">{{ $room->room_type }}</p>
                    </div>
                    <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full {{ $room->room_status === 'Available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $room->room_status }}
                    </span>
                </div>

                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">
                        Rp {{ number_format($room->room_price, 0, ',', '.') }}<span class="text-base font-normal text-gray-600">/bulan</span>
                    </h2>
                </div>

                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Deskripsi Kamar</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $room->room_description }}</p>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <div class="flex justify-between items-center">
                        <a href="{{ route('user.rooms.index') }}" class="text-gray-600 hover:text-gray-800">
                            <span class="inline-flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali ke Daftar Kamar
                            </span>
                        </a>
                        @if($room->room_status === 'Available')
                            <button class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors">
                                Pesan Kamar
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 