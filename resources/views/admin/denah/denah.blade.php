@extends('layouts.admin')

@section('header')
    Denah Kamar
@endsection

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Denah Kamar Ez Coliving</h2>
        
        <!-- Floor Selector -->
        <div class="flex space-x-4 mb-6">
            <button class="floor-btn px-6 py-2 rounded-lg bg-green-600 text-white font-semibold active" data-floor="1">
                Lantai 1
            </button>
            <button class="floor-btn px-6 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold" data-floor="2">
                Lantai 2
            </button>
            <button class="floor-btn px-6 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold" data-floor="3">
                Lantai 3
            </button>
            <button class="floor-btn px-6 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold" data-floor="4">
                Lantai 4
            </button>
        </div>
        
        <!-- Denah Container -->
        <div class="relative w-full border-2 border-gray-300 rounded-lg overflow-hidden" style="height: 600px;">
            <!-- Floor 1 -->
            <div class="floor-content active" data-floor="1">
                <div class="absolute inset-0 p-4">
                    <!-- Lorong -->
                    <div class="absolute bg-gray-200 text-center py-2 text-gray-600 font-medium"
                         style="top: 40%; left: 5%; width: 90%; height: 20%;">
                        Lorong
                    </div>
                    
                    <!-- Kamar Atas -->
                    <div class="absolute grid grid-cols-5 gap-4" style="top: 5%; left: 5%; width: 90%; height: 30%;">
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="1BE">
                            <span class="font-bold">1BE</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="1BD">
                            <span class="font-bold">1BD</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="1BC">
                            <span class="font-bold">1BC</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="1BB">
                            <span class="font-bold">1BB</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="1BA">
                            <span class="font-bold">1BA</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                    </div>
                    
                    <!-- Kamar Bawah -->
                    <div class="absolute grid grid-cols-6 gap-4" style="bottom: 5%; left: 5%; width: 90%; height: 30%;">
                        <div class="col-span-1"></div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="1AC">
                            <span class="font-bold">1AC</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="bg-gray-400 rounded-lg flex items-center justify-center p-2">
                            <span class="text-white text-sm">Gudang</span>
                        </div>
                        <div class="bg-gray-400 rounded-lg flex items-center justify-center p-2">
                            <span class="text-white text-sm">Stair</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="1AB">
                            <span class="font-bold">1AB</span>
                            <span class="text-xs">(Deluxe)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="1AA">
                            <span class="font-bold">1AA</span>
                            <span class="text-xs">(Deluxe)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Floor 2 -->
            <div class="floor-content hidden" data-floor="2">
                <div class="absolute inset-0 p-4">
                    <!-- Lorong -->
                    <div class="absolute bg-gray-200 text-center py-2 text-gray-600 font-medium"
                         style="top: 40%; left: 5%; width: 90%; height: 20%;">
                        Lorong
                    </div>
                    
                    <!-- Kamar Atas -->
                    <div class="absolute grid grid-cols-5 gap-4" style="top: 5%; left: 5%; width: 90%; height: 30%;">
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="2BE">
                            <span class="font-bold">2BE</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="2BD">
                            <span class="font-bold">2BD</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="2BC">
                            <span class="font-bold">2BC</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="2BB">
                            <span class="font-bold">2BB</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="2BA">
                            <span class="font-bold">2BA</span>
                            <span class="text-xs">(Suite)</span>
                        </div>
                    </div>
                    
                    <!-- Kamar Bawah -->
                    <div class="absolute grid grid-cols-5 gap-4" style="bottom: 5%; left: 5%; width: 90%; height: 30%;">
                        <div class="bg-gray-400 col-span-2 rounded-lg flex items-center justify-center p-2">
                            <span class="text-white text-sm">Pantry</span>
                        </div>
                        <div class="bg-gray-400 rounded-lg flex items-center justify-center p-2">
                            <span class="text-white text-sm">Stair</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="2AB">
                            <span class="font-bold">2AB</span>
                            <span class="text-xs">(Deluxe)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="2AA">
                            <span class="font-bold">2AA</span>
                            <span class="text-xs">(Suite)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Floor 3 -->
            <div class="floor-content hidden" data-floor="3">
                <div class="absolute inset-0 p-4">
                    <!-- Lorong -->
                    <div class="absolute bg-gray-200 text-center py-2 text-gray-600 font-medium"
                         style="top: 40%; left: 5%; width: 90%; height: 20%;">
                        Lorong
                    </div>
                    
                    <!-- Kamar Atas -->
                    <div class="absolute grid grid-cols-6 gap-4" style="top: 5%; left: 5%; width: 90%; height: 30%;">
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="3BE">
                            <span class="font-bold">3BE</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="3BD">
                            <span class="font-bold">3BD</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="3BC">
                            <span class="font-bold">3BC</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="bg-gray-400 rounded-lg flex items-center justify-center p-2">
                            <span class="text-white text-sm">Stair</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="3BB">
                            <span class="font-bold">3BB</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="3BA">
                            <span class="font-bold">3BA</span>
                            <span class="text-xs">(Suite)</span>
                        </div>
                    </div>
                    
                    <!-- Kamar Bawah -->
                    <div class="absolute grid grid-cols-5 gap-4" style="bottom: 5%; left: 5%; width: 90%; height: 30%;">
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="3AE">
                            <span class="font-bold">3AE</span>
                            <span class="text-xs">(Mezzanine)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="3AD">
                            <span class="font-bold">3AD</span>
                            <span class="text-xs">(Mezzanine)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="3AC">
                            <span class="font-bold">3AC</span>
                            <span class="text-xs">(Deluxe)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="3AB">
                            <span class="font-bold">3AB</span>
                            <span class="text-xs">(Deluxe)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="3AA">
                            <span class="font-bold">3AA</span>
                            <span class="text-xs">(Suite)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Floor 4 -->
            <div class="floor-content hidden" data-floor="4">
                <div class="absolute inset-0 p-4">
                    <!-- Lorong -->
                    <div class="absolute bg-gray-200 text-center py-2 text-gray-600 font-medium"
                         style="top: 40%; left: 5%; width: 90%; height: 20%;">
                        Lorong
                    </div>
                    
                    <!-- Kamar Atas -->
                    <div class="absolute grid grid-cols-6 gap-4" style="top: 5%; left: 5%; width: 90%; height: 30%;">
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="4BE">
                            <span class="font-bold">4BE</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="4BD">
                            <span class="font-bold">4BD</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="4BC">
                            <span class="font-bold">4BC</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="bg-gray-400 rounded-lg flex items-center justify-center p-2">
                            <span class="text-white text-sm">Stair</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="4BB">
                            <span class="font-bold">4BB</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="4BA">
                            <span class="font-bold">4BA</span>
                            <span class="text-xs">(Suite)</span>
                        </div>
                    </div>
                    
                    <!-- Kamar Bawah -->
                    <div class="absolute grid grid-cols-5 gap-4" style="bottom: 5%; left: 5%; width: 90%; height: 30%;">
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="4AE">
                            <span class="font-bold">4AE</span>
                            <span class="text-xs">(Mezzanine)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="4AD">
                            <span class="font-bold">4AD</span>
                            <span class="text-xs">(Mezzanine)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="4AB">
                            <span class="font-bold">4AB</span>
                            <span class="text-xs">(Deluxe)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="4AB">
                            <span class="font-bold">4AB</span>
                            <span class="text-xs">(Deluxe)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer"
                             data-room="4AA">
                            <span class="font-bold">4AA</span>
                            <span class="text-xs">(Suite)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Detail Kamar -->
        <div id="roomModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-900" id="roomTitle">Detail Kamar</h3>
                        <button id="closeModal" class="text-gray-600 hover:text-gray-900">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div id="roomDetails" class="space-y-4">
                        <!-- Detail kamar akan diisi dengan JavaScript -->
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button id="viewRoomDetails" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition-colors">
                            Lihat Detail Lengkap
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data kamar dari database
            const roomData = @json($rooms);
            
            // Floor switching
            const floorButtons = document.querySelectorAll('.floor-btn');
            const floorContents = document.querySelectorAll('.floor-content');
            
            floorButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const floor = button.getAttribute('data-floor');
                    
                    // Update buttons
                    floorButtons.forEach(btn => {
                        btn.classList.remove('bg-green-600', 'text-white');
                        btn.classList.add('bg-gray-200', 'text-gray-700');
                    });
                    button.classList.remove('bg-gray-200', 'text-gray-700');
                    button.classList.add('bg-green-600', 'text-white');
                    
                    // Update content
                    floorContents.forEach(content => {
                        content.classList.add('hidden');
                        if (content.getAttribute('data-floor') === floor) {
                            content.classList.remove('hidden');
                        }
                    });
                });
            });
            
            // Modal functionality
            const modal = document.getElementById('roomModal');
            const closeModalBtn = document.getElementById('closeModal');
            const roomTitle = document.getElementById('roomTitle');
            const roomDetails = document.getElementById('roomDetails');
            const viewRoomDetailsBtn = document.getElementById('viewRoomDetails');
            let activeRoomId = null;
            
            function showRoomDetails(roomId) {
                activeRoomId = roomId;
                
                // Konversi nomor kamar ke format yang sesuai dengan database
                const roomNumber = roomId.toString().padStart(3, '0');
                const room = Object.values(roomData).find(r => r.room_number === roomNumber) || null;
                
                roomTitle.textContent = `Kamar ${roomId}`;
                
                if (room) {
                    const formattedPrice = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(room.room_price);
                    
                    roomDetails.innerHTML = `
                        <div class="flex items-center mb-3">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full ${room.room_status === 'Tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                                ${room.room_status || 'Tidak diketahui'}
                            </span>
                        </div>
                        <p class="text-lg font-semibold text-gray-900">${formattedPrice}/bulan</p>
                        <div class="grid grid-cols-2 gap-4 mt-3">
                            <div>
                                <p class="text-sm text-gray-600">Tipe Kamar</p>
                                <p class="font-medium">${room.room_type || 'Standard'}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Nomor Kamar</p>
                                <p class="font-medium">${room.room_number}</p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <p class="text-sm text-gray-600">Deskripsi</p>
                            <p class="font-medium">${room.room_description || 'Tidak ada deskripsi'}</p>
                        </div>
                    `;
                    
                    // Tampilkan tombol detail lengkap
                    viewRoomDetailsBtn.classList.remove('hidden');
                } else {
                    roomDetails.innerHTML = `
                        <div class="text-center py-4">
                            <p class="text-gray-500">Detail kamar belum tersedia di database</p>
                            <p class="text-sm text-gray-400 mt-2">Silakan tambahkan data kamar ${roomId} terlebih dahulu</p>
                        </div>
                    `;
                    
                    // Sembunyikan tombol detail lengkap
                    viewRoomDetailsBtn.classList.add('hidden');
                }
                
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden'; // Mencegah scroll pada background
            }
            
            // Event listener untuk semua kamar
            document.querySelectorAll('.room-item').forEach(room => {
                room.addEventListener('click', function() {
                    const roomId = this.getAttribute('data-room');
                    showRoomDetails(roomId);
                });
                
                // Update warna kamar berdasarkan status dari database
                const roomId = room.getAttribute('data-room');
                const roomNumber = roomId.toString().padStart(3, '0');
                const roomInfo = Object.values(roomData).find(r => r.room_number === roomNumber);
                
                if (roomInfo) {
                    if (roomInfo.room_status === 'Terisi') {
                        room.classList.remove('bg-gray-100', 'border-gray-300');
                        room.classList.add('bg-red-100', 'border-red-300');
                    } else if (roomInfo.room_status === 'Tersedia') {
                        room.classList.remove('bg-gray-100', 'border-gray-300');
                        room.classList.add('bg-green-100', 'border-green-300');
                    }
                }
            });
            
            // Fungsi untuk menutup modal
            function closeModal() {
                modal.classList.add('hidden');
                document.body.style.overflow = ''; // Mengembalikan scroll pada background
                activeRoomId = null;
            }
            
            // Event listeners untuk menutup modal
            closeModalBtn.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closeModal();
                }
            });
            
            // Tambahkan event listener untuk tombol Escape
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });
            
            // Tombol lihat detail lengkap
            viewRoomDetailsBtn.addEventListener('click', function() {
                if (activeRoomId) {
                    const roomNumber = activeRoomId.toString().padStart(3, '0');
                    const room = Object.values(roomData).find(r => r.room_number === roomNumber);
                    if (room) {
                        window.location.href = `/admin/rooms/${room.id}`;
                    }
                }
            });
        });
    </script>
@endsection 