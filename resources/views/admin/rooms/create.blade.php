@extends('layouts.admin')

@section('header', 'Tambah Kamar Baru')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.rooms.index') }}" class="text-green-600 hover:text-green-900">
            &larr; Kembali ke daftar kamar
        </a>
    </div>

    <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
            <div>
                <label for="room_name" class="block text-sm font-medium text-gray-700">Nama Kamar</label>
                <input type="text" name="room_name" id="room_name" value="{{ old('room_name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                @error('room_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="room_number" class="block text-sm font-medium text-gray-700">Nomor Kamar</label>
                <input type="text" name="room_number" id="room_number" value="{{ old('room_number') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                @error('room_number')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="room_type" class="block text-sm font-medium text-gray-700">Tipe Kamar</label>
                <input type="text" name="room_type" id="room_type" value="{{ old('room_type') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                @error('room_type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="room_price" class="block text-sm font-medium text-gray-700">Harga Kamar (Rp)</label>
                <input type="text" name="room_price" id="room_price" value="{{ old('room_price') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                @error('room_price')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="daily_price" class="block text-sm font-medium text-gray-700">Harga Harian (Rp)</label>
                <input type="text" name="daily_price" id="daily_price" value="{{ old('daily_price') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                @error('daily_price')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="deposit_price" class="block text-sm font-medium text-gray-700">Deposit (Rp)</label>
                <input type="text" name="deposit_price" id="deposit_price" value="{{ old('deposit_price') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                @error('deposit_price')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="room_status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="room_status" id="room_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50" required>
                    <option value="Available" {{ old('room_status') == 'Available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Booked" {{ old('room_status') == 'Booked' ? 'selected' : '' }}>Terpesan</option>
                    <option value="Maintenance" {{ old('room_status') == 'Maintenance' ? 'selected' : '' }}>Pemeliharaan</option>
                </select>
                @error('room_status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="sm:col-span-2">
                <label for="room_description" class="block text-sm font-medium text-gray-700">Deskripsi Kamar</label>
                <textarea name="room_description" id="room_description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">{{ old('room_description') }}</textarea>
                @error('room_description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="room_image1" class="block text-sm font-medium text-gray-700">Foto Kamar 1</label>
                <div class="mt-1">
                    <div id="preview-image1" class="hidden mb-2">
                        <img id="preview-img1" src="#" alt="Preview Image 1" class="h-32 object-cover rounded-md">
                    </div>
                    <input type="file" name="room_image1" id="room_image1" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-md" accept="image/*" onchange="previewImage(this, 'preview-img1', 'preview-image1')">
                </div>
                @error('room_image1')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="room_image2" class="block text-sm font-medium text-gray-700">Foto Kamar 2</label>
                <div class="mt-1">
                    <div id="preview-image2" class="hidden mb-2">
                        <img id="preview-img2" src="#" alt="Preview Image 2" class="h-32 object-cover rounded-md">
                    </div>
                    <input type="file" name="room_image2" id="room_image2" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-md" accept="image/*" onchange="previewImage(this, 'preview-img2', 'preview-image2')">
                </div>
                @error('room_image2')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="room_image3" class="block text-sm font-medium text-gray-700">Foto Kamar 3</label>
                <div class="mt-1">
                    <div id="preview-image3" class="hidden mb-2">
                        <img id="preview-img3" src="#" alt="Preview Image 3" class="h-32 object-cover rounded-md">
                    </div>
                    <input type="file" name="room_image3" id="room_image3" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-md" accept="image/*" onchange="previewImage(this, 'preview-img3', 'preview-image3')">
                </div>
                @error('room_image3')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="room_image4" class="block text-sm font-medium text-gray-700">Foto Kamar 4</label>
                <div class="mt-1">
                    <div id="preview-image4" class="hidden mb-2">
                        <img id="preview-img4" src="#" alt="Preview Image 4" class="h-32 object-cover rounded-md">
                    </div>
                    <input type="file" name="room_image4" id="room_image4" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-md" accept="image/*" onchange="previewImage(this, 'preview-img4', 'preview-image4')">
                </div>
                @error('room_image4')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="sm:col-span-2">
                <label for="room_image5" class="block text-sm font-medium text-gray-700">Foto Kamar 5</label>
                <div class="mt-1">
                    <div id="preview-image5" class="hidden mb-2">
                        <img id="preview-img5" src="#" alt="Preview Image 5" class="h-32 object-cover rounded-md">
                    </div>
                    <input type="file" name="room_image5" id="room_image5" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-md" accept="image/*" onchange="previewImage(this, 'preview-img5', 'preview-image5')">
                </div>
                <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF (Maks. 2MB)</p>
                @error('room_image5')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">
                Simpan Kamar
            </button>
        </div>
    </form>

    @push('scripts')
    <script>
    function previewImage(input, previewId, containerId) {
        const preview = document.getElementById(previewId);
        const container = document.getElementById(containerId);
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.remove('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            container.classList.add('hidden');
        }
    }
    </script>
    @endpush
@endsection 