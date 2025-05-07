@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Detail Pemesanan #{{ $booking->booking_number }}</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.bookings.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                Kembali
            </a>
        </div>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    
    <!-- Status Bar -->
    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <div class="flex flex-wrap justify-between items-center">
            <div>
                <span class="text-gray-600">Status Pemesanan:</span>
                @if($booking->booking_status == 'Pending')
                    <span class="ml-2 px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-800">Menunggu Pembayaran</span>
                @elseif($booking->booking_status == 'Confirmed')
                    <span class="ml-2 px-3 py-1 text-sm rounded-full bg-green-100 text-green-800">Dikonfirmasi</span>
                @elseif($booking->booking_status == 'Cancelled')
                    <span class="ml-2 px-3 py-1 text-sm rounded-full bg-red-100 text-red-800">Dibatalkan</span>
                @elseif($booking->booking_status == 'Completed')
                    <span class="ml-2 px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-800">Selesai</span>
                @endif
            </div>
            <div>
                <span class="text-gray-600">Status Pembayaran:</span>
                @if($booking->payment->payment_status == 'Pending')
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                        Menunggu Konfirmasi
                    </span>
                @elseif($booking->payment->payment_status == 'Confirmed')
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Dikonfirmasi
                    </span>
                @elseif($booking->payment->payment_status == 'Failed')
                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                        Ditolak
                    </span>
                @endif
            </div>
            <div class="mt-2 md:mt-0">
                @if($booking->payment->payment_status == 'Pending' && $booking->payment->payment_image)
                    <div class="flex space-x-2">
                        <button type="button"
                            onclick="openModal('confirm-payment-{{ $booking->payment->id }}')"
                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                            Konfirmasi Pembayaran
                        </button>
                        <button type="button"
                            onclick="openModal('reject-payment-{{ $booking->payment->id }}')"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                            Tolak Pembayaran
                        </button>
                    </div>

                    <x-confirmation-modal id="confirm-payment-{{ $booking->payment->id }}"
                                        title="Konfirmasi Pembayaran"
                                        message="Apakah Anda yakin ingin mengkonfirmasi pembayaran ini?">
                        <form id="form-confirm-payment-{{ $booking->payment->id }}" 
                              action="{{ route('admin.payments.confirm', $booking->payment->id) }}" 
                              method="POST"
                              x-ref="form">
                            @csrf
                        </form>
                    </x-confirmation-modal>

                    <x-confirmation-modal id="reject-payment-{{ $booking->payment->id }}"
                                        title="Tolak Pembayaran"
                                        message="Apakah Anda yakin ingin menolak pembayaran ini?">
                        <form id="form-reject-payment-{{ $booking->payment->id }}" 
                              action="{{ route('admin.payments.reject', $booking->payment->id) }}" 
                              method="POST"
                              x-ref="form">
                            @csrf
                        </form>
                    </x-confirmation-modal>
                @endif
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informasi Kamar -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Informasi Kamar</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-gray-600 text-sm">Nomor Kamar</p>
                    <p class="font-medium">{{ $booking->room->room_number }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Tipe Kamar</p>
                    <p class="font-medium">{{ $booking->room->room_type }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Tanggal Pesan</p>
                    <p class="font-medium">{{ $booking->booking_date->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Periode Sewa</p>
                    <p class="font-medium">
                        @if($booking->rental_type == 'monthly')
                            {{ $booking->rental_duration }} bulan
                        @else
                            {{ $booking->rental_duration }} hari
                        @endif
                    </p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Check-in</p>
                    <p class="font-medium">{{ $booking->booking_date_in->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Check-out</p>
                    <p class="font-medium">{{ $booking->booking_date_out->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Harga</p>
                    <p class="font-medium">
                        @if($booking->rental_type == 'monthly')
                            Rp {{ number_format($booking->room->room_price, 0, ',', '.') }} / bulan
                        @else
                            Rp {{ number_format($booking->room->daily_price, 0, ',', '.') }} / hari
                        @endif
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Informasi Pemesan -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Informasi Pemesan</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-gray-600 text-sm">Nama</p>
                    <p class="font-medium">{{ $booking->name_booking }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Nomor Telepon</p>
                    <p class="font-medium">{{ $booking->phone_booking }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Email</p>
                    <p class="font-medium">{{ $booking->email_booking ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Device Info</p>
                    <p class="font-medium text-sm break-words">{{ $booking->guestUser->device_name ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Aktivitas Terakhir</p>
                    <p class="font-medium">{{ optional($booking->guestUser->last_activity)->format('d M Y H:i') ?? '-' }}</p>
                </div>
            </div>
        </div>
        
        <!-- Informasi Pembayaran -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Informasi Pembayaran</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-gray-600 text-sm">Metode Pembayaran</p>
                    <p class="font-medium">{{ $booking->payment->payment_name }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Nomor Rekening/Akun</p>
                    <p class="font-medium">{{ $booking->payment->payment_number }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Total Pembayaran</p>
                    <p class="font-semibold text-lg">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                </div>
                
                @if($booking->payment->payment_image)
                <div class="pt-4">
                    <p class="text-gray-600 text-sm mb-2">Bukti Pembayaran</p>
                    <a href="{{ asset($booking->payment->payment_image) }}" target="_blank">
                        <img src="{{ asset($booking->payment->payment_image) }}" alt="Bukti Pembayaran" class="h-48 object-contain rounded-md border border-gray-200">
                    </a>
                </div>
                @else
                <div class="pt-4">
                    <p class="text-red-500 text-sm">Belum ada bukti pembayaran</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 