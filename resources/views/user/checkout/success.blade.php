@extends('user.layout')

@section('content')
<div class="container mx-auto px-4 py-8 mt-16 pl-12">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 text-center">
                <div class="mb-6">
                    <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <h1 class="text-3xl font-bold text-gray-800 mb-4">Bukti Pembayaran Berhasil Diunggah!</h1>
                <p class="text-gray-600 mb-8">Terima kasih telah mengupload bukti pembayaran. Tim kami akan segera memproses pembayaran Anda.</p>

                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="text-left">
                            <h3 class="font-semibold text-gray-800 mb-2">Detail Kamar</h3>
                            <p class="text-gray-600">Nomor Kamar: {{ $booking->room->room_number }}</p>
                            <p class="text-gray-600">Tipe Kamar: {{ $booking->room->room_type }}</p>
                        </div>
                        <div class="text-left">
                            <h3 class="font-semibold text-gray-800 mb-2">Detail Pemesanan</h3>
                            <p class="text-gray-600">Check-in: {{ $booking->booking_date_in->format('d M Y') }}</p>
                            <p class="text-gray-600">Check-out: {{ $booking->booking_date_out->format('d M Y') }}</p>
                        </div>
                        <div class="text-left">
                            <h3 class="font-semibold text-gray-800 mb-2">Detail Pembayaran</h3>
                            <p class="text-gray-600">Total: Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                            <p class="text-gray-600">Metode: {{ $booking->payment->payment_name }}</p>
                        </div>
                        <div class="text-left">
                            <h3 class="font-semibold text-gray-800 mb-2">Status</h3>
                            <p class="text-gray-600">Pemesanan: {{ ucfirst($booking->booking_status) }}</p>
                            <p class="text-gray-600">Pembayaran: {{ ucfirst($booking->payment->payment_status) }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
                    <h3 class="font-semibold text-blue-800 mb-4">Status Pembayaran</h3>
                    <p class="text-blue-700 mb-2">Bukti pembayaran Anda sebesar <span class="font-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span> telah berhasil diunggah.</p>
                    <p class="text-blue-700">Tim kami akan segera memverifikasi pembayaran Anda dalam 1x24 jam dan akan segera menghubungi Anda.</p>
                    <p class="text-sm text-blue-700 mt-4">Jika ada pertanyaan, silakan hubungi kami melalui WhatsApp di nomor yang tertera.</p>
                </div>

                <div class="flex justify-center space-x-4">
                    <a href="{{ route('user.bookings.history') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Lihat Riwayat Pemesanan
                    </a>
                    <a href="{{ route('userhome') }}" 
                       class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 