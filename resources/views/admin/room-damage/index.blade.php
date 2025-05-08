@extends('layouts.admin')

@section('title', 'Daftar Kerusakan Kamar')

@section('content')
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Kerusakan Kamar</h2>
            <a href="{{ route('admin.room-damages.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-plus fa-sm mr-2"></i> Tambah Kerusakan
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
        <div class="bg-gradient-to-r from-green-600 to-green-700 p-4 flex justify-between items-center">
            <h3 class="text-lg font-medium text-white">Kerusakan Kamar</h3>
            
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="text-white flex items-center focus:outline-none">
                    <i class="fas fa-filter fa-sm mr-2"></i> Filter
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                    <div class="py-1 border-b border-gray-200 px-4 text-sm text-gray-600">Status Pembayaran:</div>
                    <a href="{{ route('admin.room-damages.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ !request('filter') ? 'bg-gray-100 font-semibold' : '' }}">
                        <i class="fas fa-list fa-sm mr-2 text-gray-500"></i> Semua
                    </a>
                    <a href="{{ route('admin.room-damages.index', ['filter' => 'unpaid']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request('filter') == 'unpaid' ? 'bg-gray-100 font-semibold' : '' }}">
                        <i class="fas fa-times-circle fa-sm mr-2 text-red-500"></i> Belum Dibayar
                    </a>
                    <a href="{{ route('admin.room-damages.index', ['filter' => 'pending']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request('filter') == 'pending' ? 'bg-gray-100 font-semibold' : '' }}">
                        <i class="fas fa-clock fa-sm mr-2 text-yellow-500"></i> Menunggu Konfirmasi
                    </a>
                    <a href="{{ route('admin.room-damages.index', ['filter' => 'paid']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request('filter') == 'paid' ? 'bg-gray-100 font-semibold' : '' }}">
                        <i class="fas fa-check-circle fa-sm mr-2 text-green-500"></i> Sudah Dibayar
                    </a>
                    <div class="border-t border-gray-200"></div>
                    <a href="{{ route('admin.room-damages.pending-payments') }}" class="block px-4 py-2 text-sm font-medium text-green-600 hover:bg-gray-100">
                        <i class="fas fa-bell fa-sm mr-2"></i> Pembayaran Tertunda
                    </a>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[5%]">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[15%]">Kamar</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[15%]">Kategori</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[15%]">Pengguna</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[10%]">Biaya</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[10%]">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[15%]">Tanggal</th>
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
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($damage->payment_status == 'Unpaid')
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i> Belum Dibayar
                                    </span>
                                @elseif($damage->payment_status == 'Pending')
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i> Menunggu
                                    </span>
                                @else
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Dibayar
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $damage->created_at->format('d M Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.room-damages.show', $damage->id) }}" class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.room-damages.edit', $damage->id) }}" class="text-green-600 hover:text-green-900" title="Edit Data">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($damage->payment_status == 'Pending')
                                        <form action="{{ route('admin.room-damages.confirm-payment', $damage->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:text-green-900" onclick="return confirm('Konfirmasi pembayaran ini?')" title="Konfirmasi Pembayaran">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.room-damages.destroy', $damage->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Hapus Data">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($damages->count() == 0)
            <div class="text-center py-10">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data kerusakan yang ditemukan</h3>
                @if(request('filter'))
                    <p class="mt-1 text-sm text-gray-500">Coba ubah filter atau tambahkan data baru</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.room-damages.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            <i class="fas fa-list fa-sm mr-2"></i> Tampilkan Semua Data
                        </a>
                    </div>
                @else
                    <div class="mt-6">
                        <a href="{{ route('admin.room-damages.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700">
                            <i class="fas fa-plus fa-sm mr-2"></i> Tambah Kerusakan Baru
                        </a>
                    </div>
                @endif
            </div>
        @endif
        
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $damages->links() }}
        </div>
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