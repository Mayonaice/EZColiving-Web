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