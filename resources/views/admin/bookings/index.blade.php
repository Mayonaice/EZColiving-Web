@extends('admin.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Daftar Pemesanan</h1>
        <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Kembali ke Dashboard
        </a>
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
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-4 bg-gray-50 border-b">
            <div class="flex flex-wrap items-center">
                <div class="mr-4 mb-2">
                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Menunggu: {{ $bookings->where('booking_status', 'Pending')->count() }}</span>
                </div>
                <div class="mr-4 mb-2">
                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Dikonfirmasi: {{ $bookings->where('booking_status', 'Confirmed')->count() }}</span>
                </div>
                <div class="mr-4 mb-2">
                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Dibatalkan: {{ $bookings->where('booking_status', 'Cancelled')->count() }}</span>
                </div>
                <div class="mr-4 mb-2">
                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Selesai: {{ $bookings->where('booking_status', 'Completed')->count() }}</span>
                </div>
            </div>
        </div>
        
        @if($bookings->isEmpty())
            <div class="p-6 text-center">
                <p class="text-gray-500">Belum ada data pemesanan.</p>
            </div>
        @else
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Pemesanan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kamar</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemesan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-in / Check-out</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pembayaran</th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($bookings as $booking)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $booking->booking_number }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $booking->room->room_number }} ({{ $booking->room->room_type }})
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $booking->name_booking }}<br>
                                <span class="text-xs text-gray-400">{{ $booking->phone_booking }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $booking->booking_date->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $booking->booking_date_in->format('d M Y') }} -<br>
                                {{ $booking->booking_date_out->format('d M Y') }}
                                <br>
                                <span class="text-xs text-gray-400">
                                    @if($booking->rental_type == 'monthly')
                                        {{ $booking->rental_duration }} bulan
                                    @else
                                        {{ $booking->rental_duration }} hari
                                    @endif
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($booking->booking_status == 'Pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu
                                    </span>
                                @elseif($booking->booking_status == 'Confirmed')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Dikonfirmasi
                                    </span>
                                @elseif($booking->booking_status == 'Cancelled')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Dibatalkan
                                    </span>
                                @elseif($booking->booking_status == 'Completed')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Selesai
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($booking->payment->payment_status == 'Pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu
                                    </span>
                                @elseif($booking->payment->payment_status == 'Confirmed')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Dikonfirmasi
                                    </span>
                                @elseif($booking->payment->payment_status == 'Rejected')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.bookings.show', $booking->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection 