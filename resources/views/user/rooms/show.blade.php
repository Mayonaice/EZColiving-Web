@extends('user.layout')

@section('content')
<div class="container mx-auto px-4 py-8 mt-24 pl-12">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Galeri Foto Kamar -->
            <div class="relative w-full h-72 bg-gray-100 flex items-center justify-center overflow-hidden">
                @php
                    $images = [];
                    if ($room->room_image1) $images[] = asset('storage/rooms/' . $room->room_image1);
                    if ($room->room_image2) $images[] = asset('storage/rooms/' . $room->room_image2);
                    if ($room->room_image3) $images[] = asset('storage/rooms/' . $room->room_image3);
                @endphp
                @if(count($images) > 0)
                    <img id="mainImage" src="{{ $images[0] }}" class="object-cover w-full h-full rounded-lg shadow transition-all duration-300" alt="Foto Kamar">
                    <button id="prevImageBtn" class="absolute left-2 top-1/2 -translate-y-1/2 bg-white bg-opacity-80 rounded-full p-2 shadow hover:bg-green-100 transition hidden">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    </button>
                    <button id="nextImageBtn" class="absolute right-2 top-1/2 -translate-y-1/2 bg-white bg-opacity-80 rounded-full p-2 shadow hover:bg-green-100 transition hidden">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </button>
                @else
                    <div class="flex flex-col items-center justify-center text-gray-400">
                        <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a4 4 0 004 4h10a4 4 0 004-4V7a4 4 0 00-4-4H7a4 4 0 00-4 4z" />
                        </svg>
                        <span class="text-base">Tidak ada foto kamar</span>
                    </div>
                @endif
            </div>
            <div id="thumbnails" class="flex space-x-2 mt-3 px-8 py-2 justify-center"></div>
            <!-- End Galeri Foto Kamar -->
            <div class="p-8">
                <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-6 gap-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-1 flex items-center">Kamar {{ $room->room_number }}</h1>
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 mb-2">{{ $room->room_type }}</span>
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $room->room_status === 'Available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ $room->room_status }}</span>
                            <span class="text-gray-500 text-xs">Lantai {{ $room->room_number[0] ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        <div class="text-2xl font-extrabold text-green-700 mb-1">Rp {{ number_format($room->room_price, 0, ',', '.') }}</div>
                        <div class="text-xs text-gray-500">/bulan</div>
                        @if($room->daily_price)
                        <div class="text-xs text-gray-500">Harian: Rp {{ number_format($room->daily_price, 0, ',', '.') }}/hari</div>
                        @endif
                        <div class="text-xs text-gray-500">Deposit: Rp {{ number_format($room->deposit_price, 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi Kamar</h3>
                    <p class="text-gray-600 text-sm">{{ $room->room_description }}</p>
                </div>
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Fasilitas Kamar</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @if($room->facilities && is_array($room->facilities))
                            @foreach($room->facilities as $facility)
                                <div class="flex items-center space-x-2 text-gray-700">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>{{ $facility }}</span>
                                </div>
                            @endforeach
                        @else
                            <span class="text-gray-400 text-sm">Tidak ada fasilitas khusus.</span>
                        @endif
                    </div>
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
                            <a href="{{ route('user.checkout.index', $room->id) }}" 
                               class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors">
                                Pesan Sekarang
                            </a>
                        @else
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <p class="text-yellow-700">Maaf, kamar ini sudah tidak tersedia untuk dipesan.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const images = @json($images);
    let currentImage = 0;
    const mainImage = document.getElementById('mainImage');
    const thumbnails = document.getElementById('thumbnails');
    const prevBtn = document.getElementById('prevImageBtn');
    const nextBtn = document.getElementById('nextImageBtn');
    if (images.length > 1) {
        prevBtn.style.display = '';
        nextBtn.style.display = '';
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
    }
});
</script>
@endpush
@endsection 