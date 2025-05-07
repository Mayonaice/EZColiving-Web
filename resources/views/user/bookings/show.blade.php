@extends('user.layout')

@section('content')
<div class="container mx-auto px-4 py-8 mt-16 pl-12">
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('user.bookings.history') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Riwayat Pemesanan
            </a>
        </div>

        <h1 class="text-3xl font-bold mb-8">Detail Pemesanan #{{ $booking->booking_number }}</h1>

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

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Informasi Kamar</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600 text-sm">Nomor Kamar</p>
                    <p class="font-medium">{{ $booking->room->room_number }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Tipe Kamar</p>
                    <p class="font-medium">{{ $booking->room->room_type }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Status Pemesanan</p>
                    <p>
                        @if($booking->booking_status == 'Pending')
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Menunggu Pembayaran
                            </span>
                        @elseif($booking->booking_status == 'Confirmed')
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Dikonfirmasi
                            </span>
                        @elseif($booking->booking_status == 'Cancelled')
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Dibatalkan
                            </span>
                        @elseif($booking->booking_status == 'Completed')
                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                Selesai
                            </span>
                        @endif
                    </p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Tanggal Pemesanan</p>
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
                    <p class="text-gray-600 text-sm">Tanggal Check-in</p>
                    <p class="font-medium">{{ $booking->booking_date_in->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Tanggal Check-out</p>
                    <p class="font-medium">{{ $booking->booking_date_out->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Detail Pemesan</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600 text-sm">Nama</p>
                    <p class="font-medium">{{ $booking->name_booking }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Telepon</p>
                    <p class="font-medium">{{ $booking->phone_booking }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Email</p>
                    <p class="font-medium">{{ $booking->email_booking }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Detail Pembayaran</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600 text-sm">Metode Pembayaran</p>
                    <p class="font-medium">{{ $booking->payment->payment_name }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Status Pembayaran</p>
                    <p>
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
                    </p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Total Pembayaran</p>
                    <p class="font-medium text-lg">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                </div>
                
                @if($booking->payment->payment_status == 'Pending' && !$booking->payment->payment_image)
                <div class="col-span-2 mt-4">
                    <div class="bg-yellow-50 border border-yellow-400 text-yellow-700 p-4 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Pembayaran Belum Dikonfirmasi</h3>
                                <div class="mt-2 text-sm text-yellow-700">
                                    <p>Silakan upload bukti pembayaran untuk melanjutkan proses pemesanan.</p>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('user.checkout.payment', $booking->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-yellow-700 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:border-yellow-300 focus:shadow-outline-yellow active:bg-yellow-200 transition ease-in-out duration-150">
                                        Upload Bukti Pembayaran
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                @if($booking->payment->payment_image)
                <div class="col-span-2 mt-4">
                    <p class="text-gray-600 text-sm mb-2">Bukti Pembayaran</p>
                    <img src="{{ asset($booking->payment->payment_image) }}" alt="Bukti Pembayaran" class="h-48 object-contain rounded-md border border-gray-200">
                </div>
                @endif
                
                @if(isset($booking->payment->masterPayment) && $booking->payment->masterPayment->payment_qrcode && $booking->payment->payment_status == 'Pending')
                <div class="col-span-2 mt-4">
                    <p class="text-gray-600 text-sm mb-2">QR Code Pembayaran</p>
                    <img src="{{ asset($booking->payment->masterPayment->payment_qrcode) }}" alt="QR Code Pembayaran" class="h-48 object-contain rounded-md border border-gray-200">
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 