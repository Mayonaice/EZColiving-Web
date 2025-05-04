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

                <h1 class="text-3xl font-bold text-gray-800 mb-4">Pemesanan Berhasil!</h1>
                <p class="text-gray-600 mb-8">Terima kasih telah memilih Ez Coliving. Berikut adalah detail pemesanan Anda:</p>

                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="text-left">
                            <h3 class="font-semibold text-gray-800 mb-2">Detail Kamar</h3>
                            <p class="text-gray-600">Nomor Kamar: {{ $booking->room->room_number }}</p>
                            <p class="text-gray-600">Tipe Kamar: {{ $booking->room->room_type }}</p>
                        </div>
                        <div class="text-left">
                            <h3 class="font-semibold text-gray-800 mb-2">Detail Pemesanan</h3>
                            <p class="text-gray-600">Check-in: {{ \Carbon\Carbon::parse($booking->check_in_date)->format('d M Y') }}</p>
                            <p class="text-gray-600">Check-out: {{ \Carbon\Carbon::parse($booking->check_out_date)->format('d M Y') }}</p>
                        </div>
                        <div class="text-left">
                            <h3 class="font-semibold text-gray-800 mb-2">Detail Pembayaran</h3>
                            <p class="text-gray-600">Total: Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</p>
                            <p class="text-gray-600">Metode: {{ $booking->payment->payment_name }}</p>
                        </div>
                        <div class="text-left">
                            <h3 class="font-semibold text-gray-800 mb-2">Status</h3>
                            <p class="text-gray-600">Pemesanan: {{ ucfirst($booking->status) }}</p>
                            <p class="text-gray-600">Pembayaran: {{ ucfirst($booking->payment->payment_status) }}</p>
                        </div>
                    </div>
                </div>

                @if($booking->payment->payment_status === 'Pending')
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8">
                        <h3 class="font-semibold text-yellow-800 mb-4">Instruksi Pembayaran</h3>
                        <p class="text-yellow-700 mb-4">Silakan transfer sejumlah <span class="font-bold">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</span> ke rekening berikut:</p>
                        <div class="bg-white p-4 rounded-lg">
                            <p class="font-semibold">{{ $booking->payment->payment_name }}</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $booking->payment->payment_number }}</p>
                            <p class="text-gray-600">a.n. Ez Coliving</p>
                        </div>
                        <p class="text-sm text-yellow-700 mt-4">Setelah melakukan pembayaran, silakan hubungi kami untuk konfirmasi.</p>
                    </div>
                @endif

                <div class="flex justify-center space-x-4">
                    <a href="{{ route('user.rooms.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Kembali ke Daftar Kamar
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