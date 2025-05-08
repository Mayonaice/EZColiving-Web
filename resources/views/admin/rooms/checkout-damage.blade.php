@extends('layouts.admin')

@section('title', 'Checkout dengan Kerusakan - ' . $room->room_name)

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Checkout dengan Kerusakan - {{ $room->room_name }}</h1>
        <a href="{{ route('admin.rooms.show', $room->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Checkout dengan Kerusakan</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.rooms.process-checkout-damage', $room->id) }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="room_name">Nama Kamar</label>
                                    <input type="text" class="form-control" id="room_name" value="{{ $room->room_name }} ({{ $room->room_number }})" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="guest_name">Nama Penghuni</label>
                                    <input type="text" class="form-control" id="guest_name" value="{{ $room->name_booking }}" readonly>
                                    <input type="hidden" name="guest_user_id" value="{{ $guestUser->id }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="damage_category_id">Kategori Kerusakan <span class="text-danger">*</span></label>
                            <select class="form-control @error('damage_category_id') is-invalid @enderror" id="damage_category_id" name="damage_category_id" required>
                                <option value="">-- Pilih Kategori Kerusakan --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('damage_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('damage_category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi Kerusakan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="damage_cost">Biaya Kerusakan (Rp) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('damage_cost') is-invalid @enderror" id="damage_cost" name="damage_cost" value="{{ old('damage_cost') }}" min="0" required>
                            @error('damage_cost')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> Tindakan ini akan menandai kamar sebagai <strong>Maintenance</strong> dan memerlukan pengguna untuk membayar biaya kerusakan.
                        </div>

                        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin melakukan checkout dengan kerusakan?')">Proses Checkout dengan Kerusakan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Kamar</h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <strong>Nomor Kamar:</strong> {{ $room->room_number }}
                    </div>
                    <div class="mb-2">
                        <strong>Status:</strong> 
                        <span class="badge badge-{{ $room->room_status == 'Available' ? 'success' : ($room->room_status == 'Booked' ? 'primary' : 'warning') }}">
                            {{ $room->room_status }}
                        </span>
                    </div>
                    <div class="mb-2">
                        <strong>Tipe Kamar:</strong> {{ $room->room_type }}
                    </div>
                    <div class="mb-2">
                        <strong>Harga Kamar:</strong> Rp{{ number_format($room->room_price, 0, ',', '.') }}
                    </div>
                    <div class="mb-2">
                        <strong>Penghuni:</strong> {{ $room->name_booking }}
                    </div>
                    <div class="mb-2">
                        <strong>Telepon:</strong> {{ $room->phone_booking }}
                    </div>
                    <div class="mb-2">
                        <strong>Check-in:</strong> {{ $room->date_booking_in ? $room->date_booking_in->format('d M Y') : '-' }}
                    </div>
                    <div class="mb-2">
                        <strong>Check-out:</strong> {{ $room->date_booking_out ? $room->date_booking_out->format('d M Y') : '-' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 