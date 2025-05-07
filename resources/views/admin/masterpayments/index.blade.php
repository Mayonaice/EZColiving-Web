@extends('layouts.admin')

@section('header', 'Kelola Metode Pembayaran')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Daftar Metode Pembayaran</h1>
        <a href="{{ route('admin.masterpayments.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">
            Tambah Metode Pembayaran
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nama Pembayaran
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tipe
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nomor Rekening
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        QR Code
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($masterpayments as $masterpayment)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $masterpayment->payment_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $masterpayment->payment_type }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $masterpayment->payment_account_number }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($masterpayment->payment_qrcode)
                                <img class="h-10 w-10 object-cover" 
                                     src="{{ asset('storage/masterpayments/' . $masterpayment->payment_qrcode) }}" 
                                     alt="{{ $masterpayment->payment_name }}">
                            @else
                                <div class="h-10 w-10 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500 text-xs">No QR</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusClass = [
                                    'Active' => 'bg-green-100 text-green-800',
                                    'Inactive' => 'bg-red-100 text-red-800',
                                ][$masterpayment->payment_status];
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                {{ $masterpayment->payment_status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.masterpayments.show', $masterpayment) }}" class="text-blue-600 hover:text-blue-900">
                                    Detail
                                </a>
                                <a href="{{ route('admin.masterpayments.edit', $masterpayment) }}" class="text-yellow-600 hover:text-yellow-900">
                                    Edit
                                </a>
                                <form action="{{ route('admin.masterpayments.destroy', $masterpayment) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus metode pembayaran ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="text-sm text-gray-500">Belum ada data metode pembayaran</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $masterpayments->links() }}
    </div>
@endsection 