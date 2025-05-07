@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gray-800 text-white px-6 py-4">
                <h2 class="text-xl font-semibold">Detail Pembayaran</h2>
            </div>

            <div class="p-6">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @if($payment->booking)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="text-lg font-semibold mb-4 text-gray-800">Detail Pemesanan</h5>
                            <div class="space-y-2">
                                <p class="text-gray-600">
                                    <span class="font-medium">Nomor Pemesanan:</span> {{ $payment->booking->booking_number }}
                                </p>
                                <p class="text-gray-600">
                                    <span class="font-medium">Nama:</span> {{ $payment->booking->name_booking }}
                                </p>
                                <p class="text-gray-600">
                                    <span class="font-medium">Telepon:</span> {{ $payment->booking->phone_booking }}
                                </p>
                                <p class="text-gray-600">
                                    <span class="font-medium">Email:</span> {{ $payment->booking->email_booking }}
                                </p>
                                <p class="text-gray-600">
                                    <span class="font-medium">Kamar:</span> {{ $payment->booking->room->room_name }}
                                </p>
                                <p class="text-gray-600">
                                    <span class="font-medium">Check-in:</span> {{ $payment->booking->booking_date_in }}
                                </p>
                                <p class="text-gray-600">
                                    <span class="font-medium">Check-out:</span> {{ $payment->booking->booking_date_out }}
                                </p>
                                <p class="text-gray-600">
                                    <span class="font-medium">Total:</span> Rp {{ number_format($payment->booking->total_price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h5 class="text-lg font-semibold mb-4 text-gray-800">Detail Pembayaran</h5>
                            <div class="space-y-2">
                                <p class="text-gray-600">
                                    <span class="font-medium">Metode:</span> {{ $payment->payment_name }}
                                </p>
                                <p class="text-gray-600">
                                    <span class="font-medium">Nomor Rekening:</span> {{ $payment->payment_number }}
                                </p>
                                <p class="text-gray-600">
                                    <span class="font-medium">Total:</span> Rp {{ number_format($payment->payment_amount, 0, ',', '.') }}
                                </p>
                                <p class="text-gray-600">
                                    <span class="font-medium">Status:</span> 
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $payment->payment_status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 
                                          ($payment->payment_status === 'Confirmed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $payment->payment_status }}
                                    </span>
                                </p>
                                <p class="text-gray-600">
                                    <span class="font-medium">Tanggal:</span> {{ $payment->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mb-8">
                        <h5 class="text-lg font-semibold mb-4 text-gray-800">Bukti Pembayaran</h5>
                        @if ($payment->payment_image)
                            <div class="bg-white p-4 rounded-lg shadow-md inline-block">
                                <img src="{{ asset($payment->payment_image) }}" 
                                     alt="Bukti Pembayaran" 
                                     class="max-w-full h-auto rounded-lg">
                            </div>
                        @else
                            <p class="text-gray-500">Belum ada bukti pembayaran</p>
                        @endif
                    </div>

                    @if($payment->payment_status === 'Pending')
                        <div class="flex justify-end space-x-4">
                            <button type="button" 
                                    onclick="openModal('reject-payment-{{ $payment->id }}')"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Tolak Pembayaran
                            </button>
                            <button type="button"
                                    onclick="openModal('confirm-payment-{{ $payment->id }}')"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Konfirmasi Pembayaran
                            </button>
                        </div>

                        <x-confirmation-modal id="reject-payment-{{ $payment->id }}" 
                                             title="Tolak Pembayaran" 
                                             message="Apakah Anda yakin ingin menolak pembayaran ini?">
                            <form id="form-reject-payment-{{ $payment->id }}" 
                                  action="{{ route('admin.payments.reject', $payment->id) }}" 
                                  method="POST" 
                                  x-ref="form">
                                @csrf
                            </form>
                        </x-confirmation-modal>

                        <x-confirmation-modal id="confirm-payment-{{ $payment->id }}"
                                             title="Konfirmasi Pembayaran"
                                             message="Apakah Anda yakin ingin mengkonfirmasi pembayaran ini?">
                            <form id="form-confirm-payment-{{ $payment->id }}" 
                                  action="{{ route('admin.payments.confirm', $payment->id) }}" 
                                  method="POST"
                                  x-ref="form">
                                @csrf
                            </form>
                        </x-confirmation-modal>
                    @endif
                @else
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">Data pemesanan tidak ditemukan.</span>
                    </div>
                @endif

                <div class="mt-6">
                    <a href="{{ route('admin.payments.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Kembali ke Daftar Pembayaran
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 