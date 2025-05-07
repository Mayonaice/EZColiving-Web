@extends('layouts.admin')

@section('header', 'Informasi Booking Kamar')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.rooms.show', $room) }}" class="text-green-600 hover:text-green-900">
            &larr; Kembali ke detail kamar
        </a>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{ $room->name_booking ? 'Edit Informasi Booking' : 'Tambah Booking Baru' }} - {{ $room->room_name }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                {{ $room->name_booking ? 'Ubah informasi booking untuk kamar ini' : 'Tambahkan informasi booking baru pada kamar ini' }}
            </p>
        </div>
        <div class="border-t border-gray-200">
            <form action="{{ route('admin.rooms.update-booking-info', $room) }}" method="POST" id="booking-form">
                @csrf
                @method('PUT')
                
                <div class="p-6 bg-white">
                    <!-- Status Kamar -->
                    <div class="mb-4">
                        <label for="room_status" class="block text-sm font-medium text-gray-700">Status Kamar</label>
                        <select id="room_status" name="room_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                            <option value="Available" {{ $room->room_status == 'Available' ? 'selected' : '' }}>Available</option>
                            <option value="Booked" {{ $room->room_status == 'Booked' ? 'selected' : '' }}>Booked</option>
                            <option value="Maintenance" {{ $room->room_status == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                    </div>
                    
                    <!-- Info Pemesan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="name_booking" class="block text-sm font-medium text-gray-700">Nama Pemesan</label>
                            <input type="text" name="name_booking" id="name_booking" value="{{ old('name_booking', $room->name_booking) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                            @error('name_booking')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="phone_booking" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                            <input type="text" name="phone_booking" id="phone_booking" value="{{ old('phone_booking', $room->phone_booking) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                            @error('phone_booking')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Tanggal Booking -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="date_booking" class="block text-sm font-medium text-gray-700">Tanggal Booking</label>
                            <input type="date" name="date_booking" id="date_booking" value="{{ old('date_booking', $room->date_booking ? $room->date_booking->format('Y-m-d') : date('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                            @error('date_booking')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="date_booking_in" class="block text-sm font-medium text-gray-700">Tanggal Check-in</label>
                            <input type="date" name="date_booking_in" id="date_booking_in" value="{{ old('date_booking_in', $room->date_booking_in ? $room->date_booking_in->format('Y-m-d') : date('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                            @error('date_booking_in')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="date_booking_out" class="block text-sm font-medium text-gray-700">Tanggal Check-out</label>
                            <input type="date" name="date_booking_out" id="date_booking_out" value="{{ old('date_booking_out', $room->date_booking_out ? $room->date_booking_out->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50 bg-gray-100" readonly>
                            @error('date_booking_out')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Status -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                        <div>
                            <label for="is_check_in" class="block text-sm font-medium text-gray-700">Status Check-in</label>
                            <select id="is_check_in" name="is_check_in" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                <option value="N" {{ old('is_check_in', $room->is_check_in) == 'N' ? 'selected' : '' }}>Belum Check-in</option>
                                <option value="Y" {{ old('is_check_in', $room->is_check_in) == 'Y' ? 'selected' : '' }}>Sudah Check-in</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="is_check_out" class="block text-sm font-medium text-gray-700">Status Check-out</label>
                            <select id="is_check_out" name="is_check_out" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                <option value="N" {{ old('is_check_out', $room->is_check_out) == 'N' ? 'selected' : '' }}>Belum Check-out</option>
                                <option value="Y" {{ old('is_check_out', $room->is_check_out) == 'Y' ? 'selected' : '' }}>Sudah Check-out</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="is_deposit_in" class="block text-sm font-medium text-gray-700">Status Deposit Masuk</label>
                            <select id="is_deposit_in" name="is_deposit_in" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                <option value="N" {{ old('is_deposit_in', $room->is_deposit_in) == 'N' ? 'selected' : '' }}>Belum Bayar</option>
                                <option value="Y" {{ old('is_deposit_in', $room->is_deposit_in) == 'Y' ? 'selected' : '' }}>Sudah Bayar</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="is_deposit_out" class="block text-sm font-medium text-gray-700">Status Deposit Kembali</label>
                            <select id="is_deposit_out" name="is_deposit_out" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                <option value="N" {{ old('is_deposit_out', $room->is_deposit_out) == 'N' ? 'selected' : '' }}>Belum Kembali</option>
                                <option value="Y" {{ old('is_deposit_out', $room->is_deposit_out) == 'Y' ? 'selected' : '' }}>Sudah Kembali</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Data Booking & Payment -->
                    <div class="mt-6 border-t border-gray-200 pt-4">
                        <h4 class="text-lg font-medium text-gray-900 mb-3">Data Booking & Pembayaran</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="master_payment_id" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                                <select name="master_payment_id" id="master_payment_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                    @foreach(\App\Models\MasterPayment::all() as $payment)
                                        <option value="{{ $payment->id }}">
                                            {{ $payment->payment_name }} ({{ $payment->payment_account_number }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('master_payment_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="total_price" class="block text-sm font-medium text-gray-700">Total Harga</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                        Rp
                                    </span>
                                    <input type="number" name="total_price" id="total_price" value="{{ old('total_price', $room->room_price ?? 0) }}" class="focus:ring-green-500 focus:border-green-500 flex-1 block w-full rounded-none rounded-r-md border-gray-300 bg-gray-100" readonly>
                                </div>
                                @error('total_price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="rental_type" class="block text-sm font-medium text-gray-700">Tipe Sewa</label>
                                <select name="rental_type" id="rental_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                    <option value="monthly" {{ old('rental_type', $room->rental_type) == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                                    <option value="daily" {{ old('rental_type', $room->rental_type) == 'daily' ? 'selected' : '' }}>Harian</option>
                                </select>
                                @error('rental_type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="rental_duration" class="block text-sm font-medium text-gray-700">Durasi Sewa</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="number" name="rental_duration" id="rental_duration" value="{{ old('rental_duration', $room->rental_duration ?? 1) }}" min="1" class="focus:ring-green-500 focus:border-green-500 flex-1 block w-full rounded-l-md border-gray-300">
                                    <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm rental-duration-label">
                                        Bulan
                                    </span>
                                </div>
                                @error('rental_duration')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Ringkasan Pembayaran -->
                        <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-lg font-medium text-gray-900 mb-3">Ringkasan Pembayaran</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Harga Kamar</span>
                                    <span id="room-price">Rp {{ number_format($room->room_price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Jenis Sewa</span>
                                    <span id="rental-type-display">{{ $room->rental_type == 'daily' ? 'Harian' : 'Bulanan' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Durasi Sewa</span>
                                    <span id="rental-duration-display">{{ $room->rental_duration ?? 1 }} {{ $room->rental_type == 'daily' ? 'hari' : 'bulan' }}</span>
                                </div>
                                <div class="flex justify-between" id="deposit-row" {{ $room->rental_type == 'daily' ? 'style="display: none;"' : '' }}>
                                    <span class="text-gray-600">Deposit</span>
                                    <span>Rp {{ number_format($room->deposit_price, 0, ',', '.') }}</span>
                                </div>
                                <div class="border-t pt-2">
                                    <div class="flex justify-between font-semibold">
                                        <span>Total Pembayaran</span>
                                        <span id="total-amount">Rp {{ number_format(($room->rental_type == 'daily' ? $room->daily_price : $room->room_price) * ($room->rental_duration ?? 1) + ($room->rental_type == 'daily' ? 0 : $room->deposit_price), 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elemen form
            const rentalTypeSelect = document.getElementById('rental_type');
            const rentalDurationInput = document.getElementById('rental_duration');
            const durationLabel = document.querySelector('.rental-duration-label');
            const dateBookingIn = document.getElementById('date_booking_in');
            const dateBookingOut = document.getElementById('date_booking_out');
            const totalPriceInput = document.getElementById('total_price');
            const roomPriceDisplay = document.getElementById('room-price');
            const rentalTypeDisplay = document.getElementById('rental-type-display');
            const rentalDurationDisplay = document.getElementById('rental-duration-display');
            const totalAmountDisplay = document.getElementById('total-amount');
            
            // Harga kamar
            const monthlyPrice = {{ $room->room_price ?: 0 }};
            const dailyPrice = {{ $room->daily_price ?: 0 }};
            const depositPrice = {{ $room->deposit_price ?: 0 }};
            
            // Format currency untuk tampilan
            function formatCurrency(amount) {
                return new Intl.NumberFormat('id-ID').format(amount);
            }
            
            // Update checkout date berdasarkan check-in date, tipe sewa dan durasi
            function updateCheckoutDate() {
                if (!dateBookingIn.value) return;
                
                const startDate = new Date(dateBookingIn.value);
                let endDate;
                
                if (rentalTypeSelect.value === 'monthly') {
                    // Jika bulanan, tambahkan jumlah bulan
                    const months = parseInt(rentalDurationInput.value) || 1;
                    endDate = new Date(startDate);
                    endDate.setMonth(endDate.getMonth() + months);
                } else {
                    // Jika harian, tambahkan jumlah hari
                    const days = parseInt(rentalDurationInput.value) || 1;
                    endDate = new Date(startDate);
                    endDate.setDate(endDate.getDate() + days);
                }
                
                // Format tanggal checkout (YYYY-MM-DD)
                const year = endDate.getFullYear();
                const month = String(endDate.getMonth() + 1).padStart(2, '0');
                const day = String(endDate.getDate()).padStart(2, '0');
                
                const formattedDate = `${year}-${month}-${day}`;
                dateBookingOut.value = formattedDate;
            }
            
            // Hitung total pembayaran
            function calculateTotal() {
                let basePrice, duration;
                
                if (rentalTypeSelect.value === 'monthly') {
                    basePrice = monthlyPrice;
                    duration = parseInt(rentalDurationInput.value) || 1;
                } else {
                    basePrice = dailyPrice;
                    duration = parseInt(rentalDurationInput.value) || 1;
                }
                
                const roomTotal = basePrice * duration;
                // Jika tipe sewa harian, tidak ada deposit
                const depositAmount = rentalTypeSelect.value === 'monthly' ? depositPrice : 0;
                const total = roomTotal + depositAmount;
                
                // Update tampilan
                roomPriceDisplay.textContent = 'Rp ' + formatCurrency(roomTotal);
                totalAmountDisplay.textContent = 'Rp ' + formatCurrency(total);
                totalPriceInput.value = total;
            }
            
            // Update informasi jenis sewa dan durasi
            function updateRentalInfo() {
                const isMonthly = rentalTypeSelect.value === 'monthly';
                const duration = parseInt(rentalDurationInput.value) || 1;
                
                // Update jenis sewa
                rentalTypeDisplay.textContent = isMonthly ? 'Bulanan' : 'Harian';
                
                // Update durasi
                if (isMonthly) {
                    rentalDurationDisplay.textContent = `${duration} bulan`;
                    durationLabel.textContent = 'Bulan';
                    document.getElementById('deposit-row').style.display = '';
                } else {
                    rentalDurationDisplay.textContent = `${duration} hari`;
                    durationLabel.textContent = 'Hari';
                    document.getElementById('deposit-row').style.display = 'none';
                }
            }
            
            // Event listener untuk perubahan jenis sewa
            rentalTypeSelect.addEventListener('change', function() {
                updateRentalInfo();
                calculateTotal();
                updateCheckoutDate();
            });
            
            // Event listener untuk perubahan durasi
            rentalDurationInput.addEventListener('change', function() {
                updateRentalInfo();
                calculateTotal();
                updateCheckoutDate();
            });
            
            rentalDurationInput.addEventListener('input', function() {
                updateRentalInfo();
                calculateTotal();
                updateCheckoutDate();
            });
            
            // Event listener untuk tanggal check-in
            dateBookingIn.addEventListener('change', function() {
                updateCheckoutDate();
            });
            
            // Inisialisasi form
            updateRentalInfo();
            calculateTotal();
            updateCheckoutDate();
        });
    </script>
@endsection 