@extends('layouts.admin')

@section('header', 'Detail Metode Pembayaran')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Detail Metode Pembayaran</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.masterpayments.edit', $masterpayment) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md">
                Edit
            </a>
            <a href="{{ route('admin.masterpayments.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-lg font-semibold mb-4">Informasi Pembayaran</h2>
                <div class="border-t border-gray-200 pt-4">
                    <dl class="divide-y divide-gray-200">
                        <div class="py-3 flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Nama Pembayaran</dt>
                            <dd class="text-sm text-gray-900">{{ $masterpayment->payment_name }}</dd>
                        </div>
                        <div class="py-3 flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Tipe</dt>
                            <dd class="text-sm text-gray-900">{{ $masterpayment->payment_type }}</dd>
                        </div>
                        <div class="py-3 flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Nomor Rekening/Akun</dt>
                            <dd class="text-sm text-gray-900">{{ $masterpayment->payment_account_number }}</dd>
                        </div>
                        <div class="py-3 flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="text-sm">
                                @php
                                    $statusClass = [
                                        'Active' => 'bg-green-100 text-green-800',
                                        'Inactive' => 'bg-red-100 text-red-800',
                                    ][$masterpayment->payment_status];
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                    {{ $masterpayment->payment_status }}
                                </span>
                            </dd>
                        </div>
                        <div class="py-3 flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Tanggal Dibuat</dt>
                            <dd class="text-sm text-gray-900">{{ $masterpayment->created_at->format('d-m-Y H:i') }}</dd>
                        </div>
                        <div class="py-3 flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Terakhir Diperbarui</dt>
                            <dd class="text-sm text-gray-900">{{ $masterpayment->updated_at->format('d-m-Y H:i') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
            
            <div>
                <h2 class="text-lg font-semibold mb-4">QR Code</h2>
                <div class="border-t border-gray-200 pt-4">
                    @if ($masterpayment->payment_qrcode)
                        <img src="{{ asset('storage/masterpayments/' . $masterpayment->payment_qrcode) }}" 
                             alt="{{ $masterpayment->payment_name }}" 
                             class="w-64 h-64 object-contain mx-auto">
                    @else
                        <div class="w-64 h-64 bg-gray-200 flex items-center justify-center mx-auto">
                            <span class="text-gray-500">QR Code tidak tersedia</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <form action="{{ route('admin.masterpayments.destroy', $masterpayment) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus metode pembayaran ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">
                Hapus Metode Pembayaran
            </button>
        </form>
    </div>
@endsection 