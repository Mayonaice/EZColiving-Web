@extends('layouts.admin')

@section('header', 'Edit Metode Pembayaran')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold">Edit Metode Pembayaran</h1>
    </div>

    <form action="{{ route('admin.masterpayments.update', $masterpayment) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="bg-white p-6 rounded-lg shadow-md space-y-6">
            <div>
                <label for="payment_name" class="block text-sm font-medium text-gray-700">Nama Pembayaran</label>
                <input type="text" name="payment_name" id="payment_name" value="{{ old('payment_name', $masterpayment->payment_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                @error('payment_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="payment_type" class="block text-sm font-medium text-gray-700">Tipe Pembayaran</label>
                <input type="text" name="payment_type" id="payment_type" value="{{ old('payment_type', $masterpayment->payment_type) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" placeholder="Bank, E-wallet, dll">
                @error('payment_type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="payment_account_number" class="block text-sm font-medium text-gray-700">Nomor Rekening/Akun</label>
                <input type="text" name="payment_account_number" id="payment_account_number" value="{{ old('payment_account_number', $masterpayment->payment_account_number) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                @error('payment_account_number')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="payment_qrcode" class="block text-sm font-medium text-gray-700">QR Code Pembayaran</label>
                @if ($masterpayment->payment_qrcode)
                    <div class="mb-2">
                        <p class="text-sm text-gray-500">QR Code saat ini:</p>
                        <img src="{{ asset('storage/masterpayments/' . $masterpayment->payment_qrcode) }}" alt="QR Code {{ $masterpayment->payment_name }}" class="w-32 h-32 object-cover rounded-md mt-1">
                    </div>
                @endif
                <input type="file" name="payment_qrcode" id="payment_qrcode" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md" accept="image/*">
                <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF (Maks. 2MB)</p>
                @error('payment_qrcode')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="payment_status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="payment_status" id="payment_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                    <option value="Active" {{ old('payment_status', $masterpayment->payment_status) == 'Active' ? 'selected' : '' }}>Aktif</option>
                    <option value="Inactive" {{ old('payment_status', $masterpayment->payment_status) == 'Inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                @error('payment_status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('admin.masterpayments.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md mr-2">
                Batal
            </a>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">
                Perbarui
            </button>
        </div>
    </form>
@endsection 