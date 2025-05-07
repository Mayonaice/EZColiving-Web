@extends('layouts.admin')

@section('header')
    Kategori Pengeluaran
@endsection

@section('content')
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Kategori Pengeluaran</h2>
            <a href="{{ route('admin.expense-categories.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                Tambah Kategori
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nama Kategori
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($categories as $category)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $category->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.expense-categories.edit', $category) }}" class="text-green-600 hover:text-green-900 mr-3">Edit</a>
                            <button type="button" 
                                    onclick="openModal('delete-category-{{ $category->id }}')"
                                    class="text-red-600 hover:text-red-900">
                                Hapus
                            </button>

                            <x-confirmation-modal id="delete-category-{{ $category->id }}"
                                                title="Hapus Kategori"
                                                message="Apakah Anda yakin ingin menghapus kategori ini?
                                                        
Perhatian: Semua data pengeluaran yang terkait dengan kategori ini juga akan dihapus secara permanen.">
                                <form id="form-delete-category-{{ $category->id }}" action="{{ route('admin.expense-categories.destroy', $category) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </x-confirmation-modal>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            Belum ada kategori pengeluaran.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection 