@extends('layouts.admin')

@section('header')
    Denah Kamar
@endsection

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Denah Kamar Ez Coliving</h2>
            <button id="addRoomBtn" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                Tambah Kamar Baru
            </button>
        </div>
        
        <!-- Pemilihan Lantai -->
        <div class="flex space-x-4 mb-6">
            <button class="floor-btn w-12 h-12 rounded-lg bg-green-600 text-white font-semibold active" data-floor="1"></button>
            <button class="floor-btn w-12 h-12 rounded-lg bg-gray-200 text-gray-700 font-semibold" data-floor="2"></button>
            <button class="floor-btn w-12 h-12 rounded-lg bg-gray-200 text-gray-700 font-semibold" data-floor="3"></button>
            <button class="floor-btn w-12 h-12 rounded-lg bg-gray-200 text-gray-700 font-semibold" data-floor="4"></button>
        </div>
        
        <!-- Denah Container -->
        <div class="relative w-full border-2 border-gray-300 rounded-lg overflow-hidden bg-gray-800" style="height: 600px;">
            <div class="absolute left-0 top-0 bottom-0 w-12 flex items-center justify-center">
                <h2 class="text-6xl font-bold text-white transform -rotate-0"></h2>
            </div>

            <!-- Floor 1 -->
            <div class="floor-content active" data-floor="1">
                <div class="absolute inset-0 p-4">
                    <!-- Lorong -->
                    <div class="absolute bg-gray-700 text-center py-2 text-white font-medium"
                         style="top: 42%; left: 2%; width: 96%; height: 16%;">
                        Lorong
                    </div>
                    
                    <!-- Kamar Atas -->
                    <div class="absolute grid grid-cols-5 gap-3" style="top: 2%; left: 2%; width: 96%; height: 38%;">
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="1BE">
                            <span class="font-bold">1BE</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="1BD">
                            <span class="font-bold">1BD</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="1BC">
                            <span class="font-bold">1BC</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="1BB">
                            <span class="font-bold">1BB</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="1BA">
                            <span class="font-bold">1BA</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                    </div>
                    
                    <!-- Kamar Bawah -->
                    <div class="absolute grid grid-cols-6 gap-3" style="bottom: 2%; left: 2%; width: 96%; height: 38%;">
                        <div class="col-span-1"></div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="1AC">
                            <span class="font-bold">1AC</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="bg-gray-400 rounded-lg flex items-center justify-center p-2 aspect-[3/2]">
                            <span class="text-white text-sm">Gudang</span>
                        </div>
                        <div class="bg-gray-400 rounded-lg flex items-center justify-center p-2 aspect-[3/2]">
                            <span class="text-white text-sm">Stair</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="1AB">
                            <span class="font-bold">1AB</span>
                            <span class="text-xs">(Deluxe)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="1AA">
                            <span class="font-bold">1AA</span>
                            <span class="text-xs">(Deluxe)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Floor 2 -->
            <div class="floor-content hidden" data-floor="2">
                <div class="absolute left-0 top-0 bottom-0 w-24 flex items-center justify-center">
                    <h2 class="text-6xl font-bold text-white transform -rotate-0"></h2>
                </div>
                <div class="absolute inset-0 p-4">
                    <!-- Lorong -->
                    <div class="absolute bg-gray-700 text-center py-2 text-white font-medium"
                         style="top: 42%; left: 2%; width: 96%; height: 16%;">
                        Lorong
                    </div>
                    
                    <!-- Kamar Atas -->
                    <div class="absolute grid grid-cols-5 gap-3" style="top: 2%; left: 2%; width: 96%; height: 38%;">
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="2BE">
                            <span class="font-bold">2BE</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="2BD">
                            <span class="font-bold">2BD</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="2BC">
                            <span class="font-bold">2BC</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="2BB">
                            <span class="font-bold">2BB</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="2BA">
                            <span class="font-bold">2BA</span>
                            <span class="text-xs">(Suite)</span>
                        </div>
                    </div>
                    
                    <!-- Kamar Bawah -->
                    <div class="absolute grid grid-cols-5 gap-3" style="bottom: 2%; left: 2%; width: 96%; height: 38%;">
                        <div class="bg-gray-400 col-span-2 rounded-lg flex items-center justify-center p-2" style="aspect-ratio: 2/1;">
                            <span class="text-white text-sm">Pantry</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="2AB">
                            <span class="font-bold">2AB</span>
                            <span class="text-xs">(Deluxe)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="2AA">
                            <span class="font-bold">2AA</span>
                            <span class="text-xs">(Suite)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Floor 3 -->
            <div class="floor-content hidden" data-floor="3">
                <div class="absolute left-0 top-0 bottom-0 w-24 flex items-center justify-center">
                    <h2 class="text-6xl font-bold text-white transform -rotate-0"></h2>
                </div>
                <div class="absolute inset-0 p-4">
                    <!-- Lorong -->
                    <div class="absolute bg-gray-700 text-center py-2 text-white font-medium"
                         style="top: 42%; left: 2%; width: 96%; height: 16%;">
                        Lorong
                    </div>
                    
                    <!-- Kamar Atas -->
                    <div class="absolute grid grid-cols-6 gap-3" style="top: 2%; left: 2%; width: 96%; height: 38%;">
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="3BE">
                            <span class="font-bold">3BE</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="3BD">
                            <span class="font-bold">3BD</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="3BC">
                            <span class="font-bold">3BC</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="bg-gray-400 rounded-lg flex items-center justify-center p-2 aspect-[3/2]">
                            <span class="text-white text-sm">Stair</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="3BB">
                            <span class="font-bold">3BB</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="3BA">
                            <span class="font-bold">3BA</span>
                            <span class="text-xs">(Suite)</span>
                        </div>
                    </div>
                    
                    <!-- Kamar Bawah -->
                    <div class="absolute grid grid-cols-5 gap-3" style="bottom: 2%; left: 2%; width: 96%; height: 38%;">
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="3AE">
                            <span class="font-bold">3AE</span>
                            <span class="text-xs">(Mezzanine)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="3AD">
                            <span class="font-bold">3AD</span>
                            <span class="text-xs">(Mezzanine)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="3AB">
                            <span class="font-bold">3AB</span>
                            <span class="text-xs">(Deluxe)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="3AB">
                            <span class="font-bold">3AB</span>
                            <span class="text-xs">(Deluxe)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="3AA">
                            <span class="font-bold">3AA</span>
                            <span class="text-xs">(Suite)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Floor 4 -->
            <div class="floor-content hidden" data-floor="4">
                <div class="absolute left-0 top-0 bottom-0 w-24 flex items-center justify-center">
                    <h2 class="text-6xl font-bold text-white transform -rotate-0"></h2>
                </div>
                <div class="absolute inset-0 p-4">
                    <!-- Lorong -->
                    <div class="absolute bg-gray-700 text-center py-2 text-white font-medium"
                         style="top: 42%; left: 2%; width: 96%; height: 16%;">
                        Lorong
                    </div>
                    
                    <!-- Kamar Atas -->
                    <div class="absolute grid grid-cols-6 gap-3" style="top: 2%; left: 2%; width: 96%; height: 38%;">
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="4BE">
                            <span class="font-bold">4BE</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="4BD">
                            <span class="font-bold">4BD</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="4BC">
                            <span class="font-bold">4BC</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="bg-gray-400 rounded-lg flex items-center justify-center p-2 aspect-[3/2]">
                            <span class="text-white text-sm">Stair</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="4BB">
                            <span class="font-bold">4BB</span>
                            <span class="text-xs">(Superior)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="4BA">
                            <span class="font-bold">4BA</span>
                            <span class="text-xs">(Suite)</span>
                        </div>
                    </div>
                    
                    <!-- Kamar Bawah -->
                    <div class="absolute grid grid-cols-5 gap-3" style="bottom: 2%; left: 2%; width: 96%; height: 38%;">
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="4AE">
                            <span class="font-bold">4AE</span>
                            <span class="text-xs">(Mezzanine)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="4AD">
                            <span class="font-bold">4AD</span>
                            <span class="text-xs">(Mezzanine)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="4AB">
                            <span class="font-bold">4AB</span>
                            <span class="text-xs">(Deluxe)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
                             data-room="4AB">
                            <span class="font-bold">4AB</span>
                            <span class="text-xs">(Deluxe)</span>
                        </div>
                        <div class="room-item bg-gray-100 border-2 border-gray-300 rounded-lg flex flex-col items-center justify-center p-2 cursor-pointer aspect-[3/2]"
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
            // Ambil dari DB
            const roomDataRaw = {!! json_encode($rooms) !!};
            console.log('Data mentah dari controller:', roomDataRaw);
            
            // Konversi ke format yang sesuai
            let roomData = [];
            if (Array.isArray(roomDataRaw)) {
                roomData = roomDataRaw;
            } else if (typeof roomDataRaw === 'object') {
                roomData = Object.values(roomDataRaw);
            }
            
            console.log('Data kamar setelah konversi:', roomData);
            
            // Ganti lantai
            const floorButtons = document.querySelectorAll('.floor-btn');
            const floorContents = document.querySelectorAll('.floor-content');
            
            // Debug
            console.log('Daftar nomor kamar yang tersedia:', roomData.map(r => r.room_number));
            
            floorButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const floor = button.getAttribute('data-floor');
                    
                    // Update button
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
            
            // Modal function
            const modal = document.getElementById('roomModal');
            const closeModalBtn = document.getElementById('closeModal');
            const roomTitle = document.getElementById('roomTitle');
            const roomDetails = document.getElementById('roomDetails');
            const viewRoomDetailsBtn = document.getElementById('viewRoomDetails');
            let activeRoomId = null;
            
            function showRoomDetails(denahId) {
                activeRoomId = denahId;
                
                console.log('Mencari kamar dengan ID:', denahId);
                console.log('Data kamar yang tersedia:', roomData);
                
                // Mencari data kamar berdasarkan room_number yang sesuai dengan denahId
                const room = roomData.find(r => {
                    console.log('Membandingkan:', r.room_number, denahId, r.room_number === denahId);
                    return r.room_number === denahId;
                });
                
                console.log('Kamar yang ditemukan:', room);
                
                roomTitle.textContent = `Kamar ${denahId}`;
                
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
                            <p class="text-sm text-gray-400 mt-2">Silakan tambahkan data kamar ${denahId} terlebih dahulu</p>
                        </div>
                    `;
                    
                    // Sembunyikan tombol detail lengkap
                    viewRoomDetailsBtn.classList.add('hidden');
                }
                
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
            
            // Event listener untuk semua kamar
            document.querySelectorAll('.room-item').forEach(room => {
                const denahId = room.getAttribute('data-room');
                console.log('Mengecek kamar:', denahId);
                
                const roomInfo = roomData.find(r => {
                    console.log('Membandingkan dengan:', r.room_number);
                    return r.room_number === denahId;
                });
                
                console.log('Info kamar yang ditemukan:', roomInfo);
                
                // Update warna kamar berdasarkan status
                if (roomInfo) {
                    if (roomInfo.room_status === 'Terisi') {
                        room.classList.remove('bg-gray-100', 'border-gray-300');
                        room.classList.add('bg-red-100', 'border-red-300');
                    } else if (roomInfo.room_status === 'Tersedia') {
                        room.classList.remove('bg-gray-100', 'border-gray-300');
                        room.classList.add('bg-green-100', 'border-green-300');
                    }
                }
                
                // Event click untuk menampilkan detail
                room.addEventListener('click', function() {
                    const denahId = this.getAttribute('data-room');
                    showRoomDetails(denahId);
                });
            });
            
            // Fungsi untuk menutup modal
            function closeModal() {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
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
                    const room = roomData.find(r => r.room_number === activeRoomId);
                    if (room) {
                        window.location.href = `/admin/rooms/${room.id}`;
                    }
                }
            });
        });
    </script>
@endsection 