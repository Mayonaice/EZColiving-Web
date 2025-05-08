@extends('layouts.admin')

@section('title', 'Konfirmasi Pembayaran Kerusakan Kamar')

@section('content')
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Konfirmasi Pembayaran Kerusakan Kamar</h2>
            <a href="{{ route('admin.room-damages.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-arrow-left fa-sm mr-2"></i> Kembali
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow" role="alert">
            <div class="flex">
                <div class="py-1"><i class="fas fa-check-circle text-green-500 mr-3"></i></div>
                <div>
                    <p><strong>Berhasil!</strong> {{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow" role="alert">
            <div class="flex">
                <div class="py-1"><i class="fas fa-times-circle text-red-500 mr-3"></i></div>
                <div>
                    <p><strong>Gagal!</strong> {{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 p-4">
            <h3 class="text-lg font-medium text-white flex items-center">
                <i class="fas fa-bell fa-sm mr-2"></i> Pembayaran Kerusakan Kamar yang Tertunda
            </h3>
        </div>
        
        @if($damages->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[5%]">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[15%]">Kamar</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[15%]">Kategori</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[15%]">Pengguna</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[10%]">Biaya</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[10%]">Tgl Pembayaran</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[15%]">Bukti Pembayaran</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-[15%]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($damages as $damage)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $damage->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $damage->room->room_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $damage->room->room_number }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $damage->damageCategory->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $damage->guestUser->name ?? 'Tidak ada' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">Rp{{ number_format($damage->damage_cost, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $damage->payment_date ? $damage->payment_date->format('d M Y') : '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                    @if($damage->payment_proof)
                                        <a href="{{ asset('storage/damage-payments/' . $damage->payment_proof) }}" target="_blank" class="inline-flex items-center px-3 py-1 border border-blue-300 text-blue-600 rounded hover:bg-blue-50">
                                            <i class="fas fa-image mr-2"></i> Lihat Bukti
                                        </a>
                                    @else
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Tidak ada bukti
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('admin.room-damages.show', $damage->id) }}" class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.room-damages.confirm-payment', $damage->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900" onclick="return confirm('Konfirmasi pembayaran ini?')" title="Konfirmasi Pembayaran">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.room-damages.destroy', $damage->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Tolak & Hapus">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $damages->links() }}
            </div>
        @else
            <div class="text-center py-10">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada pembayaran yang tertunda</h3>
                <p class="mt-1 text-sm text-gray-500">Semua pembayaran sudah dikonfirmasi</p>
                <div class="mt-6">
                    <a href="{{ route('admin.room-damages.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700">
                        <i class="fas fa-list fa-sm mr-2"></i> Lihat Semua Kerusakan
                    </a>
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        // DataTable untuk pencarian dan pengurutan
        document.addEventListener('DOMContentLoaded', function() {
            new simpleDatatables.DataTable("table", {
                searchable: true,
                paging: false,
                sortable: true,
                labels: {
                    placeholder: "Cari...",
                    noResults: "Tidak ada data yang ditemukan"
                }
            });
        });
    </script>
    @endpush
@endsection 