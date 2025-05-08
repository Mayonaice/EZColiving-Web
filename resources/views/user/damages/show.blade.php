@extends('user.layout')

@section('content')
<div class="container mx-auto px-4 py-8 mt-16">
    <div class="mb-6">
        <a href="{{ route('damages.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke daftar kerusakan
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
        <p>{{ session('error') }}</p>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-4 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Detail Kerusakan Kamar</h3>
        </div>

        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <div class="mb-4">
                        <h4 class="text-sm font-medium text-gray-500">Kamar</h4>
                        <p class="mt-1">{{ $damage->room->room_name }} ({{ $damage->room->room_number }})</p>
                    </div>
                    
                    <div class="mb-4">
                        <h4 class="text-sm font-medium text-gray-500">Kategori Kerusakan</h4>
                        <p class="mt-1">{{ $damage->damageCategory->name }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <h4 class="text-sm font-medium text-gray-500">Deskripsi</h4>
                        <p class="mt-1">{{ $damage->description }}</p>
                    </div>
                </div>
                
                <div>
                    <div class="mb-4">
                        <h4 class="text-sm font-medium text-gray-500">Biaya Kerusakan</h4>
                        <p class="mt-1 font-bold text-lg text-blue-700">Rp{{ number_format($damage->damage_cost, 0, ',', '.') }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <h4 class="text-sm font-medium text-gray-500">Status Pembayaran</h4>
                        <div class="mt-1">
                            @if($damage->payment_status == 'Unpaid')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Belum Dibayar
                                </span>
                            @elseif($damage->payment_status == 'Pending')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Menunggu Konfirmasi
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Sudah Dibayar
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h4 class="text-sm font-medium text-gray-500">Tanggal Kerusakan</h4>
                        <p class="mt-1">{{ $damage->created_at->format('d M Y') }}</p>
                    </div>
                    
                    @if($damage->payment_date)
                    <div class="mb-4">
                        <h4 class="text-sm font-medium text-gray-500">Tanggal Pembayaran</h4>
                        <p class="mt-1">{{ $damage->payment_date->format('d M Y') }}</p>
                    </div>
                    @endif
                </div>
            </div>
            
            @if($damage->payment_proof)
            <div class="mt-4 border-t border-gray-200 pt-4">
                <h4 class="text-sm font-medium text-gray-500 mb-2">Bukti Pembayaran</h4>
                <div class="border border-gray-200 rounded overflow-hidden max-w-sm">
                    <img src="{{ asset('storage/damage-payments/' . $damage->payment_proof) }}" alt="Bukti Pembayaran" class="w-full h-auto">
                </div>
            </div>
            @endif
        </div>
    </div>

    @if($damage->payment_status == 'Unpaid')
    <div class="mt-6 bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-4 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Upload Bukti Pembayaran</h3>
        </div>
        
        <div class="p-4">
            <form action="{{ route('damages.upload-payment', $damage->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="payment_proof" class="block text-sm font-medium text-gray-700 mb-2">
                        Bukti Pembayaran <span class="text-red-500">*</span>
                    </label>
                    <input type="file" id="payment_proof" name="payment_proof" accept="image/jpeg,image/png,image/jpg" class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <p class="mt-1 text-xs text-gray-500">Format: JPG, JPEG, PNG. Max: 2MB</p>
                    
                    @error('payment_proof')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0l-4 4m4-4v12" />
                        </svg>
                        Upload Bukti Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
    @elseif($damage->payment_status == 'Pending')
    <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-yellow-700">
                    Bukti pembayaran Anda sedang menunggu konfirmasi dari admin.
                </p>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection 