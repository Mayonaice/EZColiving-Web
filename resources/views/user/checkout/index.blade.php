@extends('user.layout')

@section('content')
<div class="container mx-auto px-4 py-8 mt-16 pl-12">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">Checkout Pemesanan</h1>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Detail Kamar</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600">Nomor Kamar</p>
                    <p class="font-semibold">{{ $room->room_number }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Tipe Kamar</p>
                    <p class="font-semibold">{{ $room->room_type }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Harga per Bulan</p>
                    <p class="font-semibold">Rp {{ number_format($room->room_price, 0, ',', '.') }}</p>
                </div>
                @if($room->daily_price)
                <div>
                    <p class="text-gray-600">Harga per Hari</p>
                    <p class="font-semibold">Rp {{ number_format($room->daily_price, 0, ',', '.') }}</p>
                </div>
                @endif
                <div>
                    <p class="text-gray-600">Deposit</p>
                    <p class="font-semibold">Rp {{ number_format($room->deposit_price, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <form action="{{ route('user.checkout.store', ['roomId' => $room->id]) }}" method="POST" class="space-y-6" id="checkout-form">
            @csrf
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Data Pemesanan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label for="rental_type" class="block text-sm font-medium text-gray-700">Jenis Sewa</label>
                        <select name="rental_type" id="rental_type" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="monthly">Bulanan</option>
                            @if($room->daily_price)
                            <option value="daily">Harian</option>
                            @endif
                        </select>
                    </div>
                    
                    <div id="monthly-duration" class="col-span-2">
                        <label for="rental_duration_monthly" class="block text-sm font-medium text-gray-700">Durasi Sewa (Bulan)</label>
                        <input type="number" name="rental_duration_monthly" id="rental_duration_monthly" value="{{ old('rental_duration_monthly', 1) }}" min="1" max="12" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    
                    <div id="daily-duration" class="col-span-2 hidden">
                        <label for="rental_duration_daily" class="block text-sm font-medium text-gray-700">Durasi Sewa (Hari)</label>
                        <input type="number" name="rental_duration_daily" id="rental_duration_daily" value="{{ old('rental_duration_daily', 1) }}" min="1" max="30"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label for="check_in_date" class="block text-sm font-medium text-gray-700">Tanggal Check-in</label>
                        <input type="date" name="check_in_date" id="check_in_date" value="{{ old('check_in_date') }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="check_out_date_display" class="block text-sm font-medium text-gray-700">Tanggal Check-out</label>
                        <input type="date" id="check_out_date_display" disabled
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100">
                        <input type="hidden" name="check_out_date" id="check_out_date" value="{{ old('check_out_date') }}">
                        @error('check_out_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Data Pembayaran</h2>
                <div class="space-y-4">
                    <div>
                        <label for="master_payment_id" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                        <select name="master_payment_id" id="master_payment_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Pilih metode pembayaran</option>
                            @foreach($masterPayments as $payment)
                                <option value="{{ $payment->id }}" 
                                    data-name="{{ $payment->payment_name }}" 
                                    data-number="{{ $payment->payment_account_number }}">
                                    {{ $payment->payment_name }} - {{ $payment->payment_account_number }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="payment-details" class="hidden">
                        <div class="bg-gray-50 p-4 rounded-md">
                            <p class="text-sm text-gray-600">Nama Penerima: <span id="payment-name" class="font-semibold"></span></p>
                            <p class="text-sm text-gray-600">Nomor Rekening: <span id="payment-number" class="font-semibold"></span></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Ringkasan Pembayaran</h2>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Harga Kamar</span>
                        <span id="room-price">Rp {{ number_format($room->room_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Jenis Sewa</span>
                        <span id="rental-type-display">Bulanan</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Durasi Sewa</span>
                        <span id="rental-duration-display">1 bulan</span>
                    </div>
                    <div class="flex justify-between" id="deposit-row">
                        <span class="text-gray-600">Deposit</span>
                        <span>Rp {{ number_format($room->deposit_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t pt-2">
                        <div class="flex justify-between font-semibold">
                            <span>Total Pembayaran</span>
                            <span id="total-amount">Rp {{ number_format($room->room_price + $room->deposit_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="total_amount" id="total_amount_input" value="{{ $room->room_price + $room->deposit_price }}">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Lanjutkan ke Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded - Initializing checkout form');
    
    // Ambil semua elemen form
    const rentalTypeSelect = document.getElementById('rental_type');
    const monthlyDuration = document.getElementById('monthly-duration');
    const dailyDuration = document.getElementById('daily-duration');
    const rentalDurationMonthly = document.getElementById('rental_duration_monthly');
    const rentalDurationDaily = document.getElementById('rental_duration_daily');
    const checkInDate = document.getElementById('check_in_date');
    const checkOutDate = document.getElementById('check_out_date');
    const checkOutDateDisplay = document.getElementById('check_out_date_display');
    const roomPriceDisplay = document.getElementById('room-price');
    const totalAmountDisplay = document.getElementById('total-amount');
    const totalAmountInput = document.getElementById('total_amount_input');
    const paymentSelect = document.getElementById('master_payment_id');
    const paymentDetails = document.getElementById('payment-details');
    const paymentName = document.getElementById('payment-name');
    const paymentNumber = document.getElementById('payment-number');
    const checkoutForm = document.getElementById('checkout-form');
    const rentalTypeDisplay = document.getElementById('rental-type-display');
    const rentalDurationDisplay = document.getElementById('rental-duration-display');

    // Logging untuk debugging
    console.log('Form elements found:', {
        rentalTypeSelect: !!rentalTypeSelect,
        monthlyDuration: !!monthlyDuration,
        dailyDuration: !!dailyDuration,
        rentalDurationMonthly: !!rentalDurationMonthly,
        rentalDurationDaily: !!rentalDurationDaily,
        checkInDate: !!checkInDate,
        checkOutDate: !!checkOutDate,
        checkOutDateDisplay: !!checkOutDateDisplay
    });

    // Harga kamar - pastikan nilainya tersedia
    const monthlyPrice = {{ $room->room_price ?: 0 }};
    const dailyPrice = {{ $room->daily_price ?: 0 }};
    const deposit = {{ $room->deposit_price ?: 0 }};
    
    console.log('Room prices loaded:', {
        monthlyPrice,
        dailyPrice,
        deposit
    });

    // Set minimum date untuk check-in ke hari ini
    const today = new Date();
    const formattedToday = today.toISOString().split('T')[0];
    checkInDate.min = formattedToday;
    
    // Jika tidak ada nilai yang disimpan, default ke hari ini
    if (!checkInDate.value) {
        checkInDate.value = formattedToday;
        console.log('Setting default check-in date to today:', formattedToday);
    }

    // Format currency untuk tampilan
    function formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID').format(amount);
    }

    // Update checkout date when check-in date, rental type or duration changes
    function updateCheckoutDate() {
        if (!checkInDate.value) return;
        
        const startDate = new Date(checkInDate.value);
        let endDate;
        
        if (rentalTypeSelect.value === 'monthly') {
            // Jika bulanan, tambahkan jumlah bulan
            const months = parseInt(rentalDurationMonthly.value) || 1;
            endDate = new Date(startDate);
            endDate.setMonth(endDate.getMonth() + months);
            console.log(`Adding ${months} months to ${startDate.toISOString().split('T')[0]}`);
        } else {
            // Jika harian, tambahkan jumlah hari
            const days = parseInt(rentalDurationDaily.value) || 1;
            endDate = new Date(startDate);
            endDate.setDate(endDate.getDate() + days);
            console.log(`Adding ${days} days to ${startDate.toISOString().split('T')[0]}`);
        }
        
        // Format tanggal checkout (YYYY-MM-DD)
        const year = endDate.getFullYear();
        const month = String(endDate.getMonth() + 1).padStart(2, '0');
        const day = String(endDate.getDate()).padStart(2, '0');
        
        const formattedDate = `${year}-${month}-${day}`;
        checkOutDate.value = formattedDate;
        checkOutDateDisplay.value = formattedDate;
        
        console.log('Checkout date updated:', {
            checkIn: checkInDate.value,
            checkOut: formattedDate,
            type: rentalTypeSelect.value, 
            duration: getCurrentDuration()
        });
    }

    // Mendapatkan durasi sesuai dengan jenis sewa yang dipilih
    function getCurrentDuration() {
        if (rentalTypeSelect.value === 'monthly') {
            return parseInt(rentalDurationMonthly.value) || 1;
        } else {
            return parseInt(rentalDurationDaily.value) || 1;
        }
    }

    // Hitung total pembayaran
    function calculateTotal() {
        let basePrice, duration;
        
        if (rentalTypeSelect.value === 'monthly') {
            basePrice = monthlyPrice;
            duration = parseInt(rentalDurationMonthly.value) || 1;
        } else {
            basePrice = dailyPrice;
            duration = parseInt(rentalDurationDaily.value) || 1;
        }
        
        const roomTotal = basePrice * duration;
        // Jika tipe sewa harian, tidak ada deposit
        const depositAmount = rentalTypeSelect.value === 'monthly' ? deposit : 0;
        const total = roomTotal + depositAmount;
        
        console.log('Calculating total:', {
            type: rentalTypeSelect.value,
            basePrice,
            duration,
            roomTotal,
            deposit: depositAmount,
            total
        });
        
        // Update tampilan
        roomPriceDisplay.textContent = 'Rp ' + formatCurrency(roomTotal);
        totalAmountDisplay.textContent = 'Rp ' + formatCurrency(total);
        totalAmountInput.value = total;
    }

    // Update informasi jenis sewa dan durasi
    function updateRentalInfo() {
        const isMonthly = rentalTypeSelect.value === 'monthly';
        const duration = getCurrentDuration();
        
        // Update jenis sewa
        rentalTypeDisplay.textContent = isMonthly ? 'Bulanan' : 'Harian';
        
        // Update durasi
        if (isMonthly) {
            rentalDurationDisplay.textContent = `${duration} bulan`;
        } else {
            rentalDurationDisplay.textContent = `${duration} hari`;
        }
        
        console.log('Rental info updated:', {
            type: rentalTypeSelect.value, 
            duration: duration,
            display: rentalDurationDisplay.textContent
        });
    }

    // Toggle tampilan input durasi berdasarkan jenis sewa
    function toggleDurationInputs() {
        const isMonthly = rentalTypeSelect.value === 'monthly';
        
        console.log('Toggling duration inputs:', {
            isMonthly,
            monthlyVisible: !monthlyDuration.classList.contains('hidden'),
            dailyVisible: !dailyDuration.classList.contains('hidden')
        });
        
        if (isMonthly) {
            monthlyDuration.classList.remove('hidden');
            dailyDuration.classList.add('hidden');
            rentalDurationMonthly.required = true;
            rentalDurationDaily.required = false;
            document.getElementById('deposit-row').style.display = '';
        } else {
            monthlyDuration.classList.add('hidden');
            dailyDuration.classList.remove('hidden');
            rentalDurationMonthly.required = false;
            rentalDurationDaily.required = true;
            document.getElementById('deposit-row').style.display = 'none';
        }
        
        updateRentalInfo();
        calculateTotal();
        updateCheckoutDate();
    }
    
    // Form submission handler
    checkoutForm.addEventListener('submit', function(e) {
        e.preventDefault();
        console.log('Form submission started');
        
        // Update checkout date dan total sebelum submit
        updateCheckoutDate();
        calculateTotal();
        
        // Siapkan hidden input untuk rental_duration
        const rentalDuration = getCurrentDuration();
        
        // Hapus input hidden yang mungkin sudah ada dari submit sebelumnya
        const existingInput = this.querySelector('input[name="rental_duration"]');
        if (existingInput) {
            existingInput.remove();
        }
        
        // Tambahkan input hidden baru
        const durationInput = document.createElement('input');
        durationInput.type = 'hidden';
        durationInput.name = 'rental_duration';
        durationInput.value = rentalDuration;
        this.appendChild(durationInput);
        
        console.log('Form ready to submit:', {
            rental_type: rentalTypeSelect.value,
            rental_duration: rentalDuration,
            check_in_date: checkInDate.value,
            check_out_date: checkOutDate.value,
            total_amount: totalAmountInput.value
        });
        
        this.submit();
    });

    // Event listener untuk metode pembayaran
    paymentSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (this.value) {
            paymentName.textContent = selectedOption.dataset.name;
            paymentNumber.textContent = selectedOption.dataset.number;
            paymentDetails.classList.remove('hidden');
        } else {
            paymentDetails.classList.add('hidden');
        }
    });

    // Event listener untuk perubahan jenis sewa
    rentalTypeSelect.addEventListener('change', function() {
        console.log('Rental type changed to:', this.value);
        toggleDurationInputs();
    });

    // Event listener untuk input durasi
    rentalDurationMonthly.addEventListener('change', function() {
        console.log('Monthly duration changed to:', this.value);
        updateRentalInfo();
        calculateTotal();
        updateCheckoutDate();
    });
    
    rentalDurationDaily.addEventListener('change', function() {
        console.log('Daily duration changed to:', this.value);
        updateRentalInfo();
        calculateTotal();
        updateCheckoutDate();
    });
    
    // Tambahkan juga event untuk keypup/input untuk update lebih responsif
    rentalDurationMonthly.addEventListener('input', function() {
        updateRentalInfo();
        calculateTotal();
        updateCheckoutDate();
    });
    
    rentalDurationDaily.addEventListener('input', function() {
        updateRentalInfo();
        calculateTotal();
        updateCheckoutDate();
    });
    
    // Event listener untuk tanggal check-in
    checkInDate.addEventListener('change', function() {
        console.log('Check-in date changed to:', this.value);
        updateCheckoutDate();
    });

    // Initialize form
    console.log('Initializing form state...');
    toggleDurationInputs();
    calculateTotal();
    updateCheckoutDate();
    updateRentalInfo();
    console.log('Form initialization complete');
});
</script>
@endpush
@endsection 