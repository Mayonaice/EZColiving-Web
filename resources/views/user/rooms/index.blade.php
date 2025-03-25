@extends('user.layout')

@section('content')
<div class="container mx-auto px-4 py-8 mt-16 pl-12">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Daftar Kamar Tersedia</h1>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($rooms as $room)
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
        @endforeach
    </div>
</div>
@endsection 