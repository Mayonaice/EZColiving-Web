@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Pengaturan WhatsApp</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Pengaturan WhatsApp</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-cog me-1"></i>
            Konfigurasi Notifikasi WhatsApp
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <p class="mb-4">
                Konfigurasi notifikasi WhatsApp yang akan dikirim setelah booking dan pembayaran dikonfirmasi.
            </p>

            <form action="{{ route('admin.settings.whatsapp.update') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="whatsapp_enabled" class="form-label">Status Notifikasi WhatsApp</label>
                    <select name="whatsapp_enabled" id="whatsapp_enabled" class="form-select @error('whatsapp_enabled') is-invalid @enderror">
                        <option value="true" {{ $whatsappSettings['whatsapp_enabled'] === 'true' ? 'selected' : '' }}>Aktif</option>
                        <option value="false" {{ $whatsappSettings['whatsapp_enabled'] === 'false' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('whatsapp_enabled')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="whatsapp_sender_number" class="form-label">Nomor Pengirim WhatsApp</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">+</span>
                        <input type="text" class="form-control @error('whatsapp_sender_number') is-invalid @enderror" 
                            id="whatsapp_sender_number" name="whatsapp_sender_number" 
                            value="{{ old('whatsapp_sender_number', $whatsappSettings['whatsapp_sender_number']) }}"
                            placeholder="628xxxxxxxxxx">
                    </div>
                    <div class="form-text">
                        Masukkan nomor WhatsApp dengan format internasional (contoh: 628xxxxxxxxxx) tanpa tanda '+'.
                    </div>
                    @error('whatsapp_sender_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="alert alert-info mb-4">
                    <h5 class="alert-heading">
                        <i class="fas fa-info-circle me-1"></i> Informasi
                    </h5>
                    <p>
                        Untuk menggunakan fitur notifikasi WhatsApp:
                    </p>
                    <ol>
                        <li>Pastikan nomor WhatsApp pengirim sudah terdaftar di layanan WhatsApp API.</li>
                        <li>Token API harus dikonfigurasi di file .env dengan nama <code>WHATSAPP_TOKEN</code>.</li>
                        <li>URL API dapat dikonfigurasi di file .env dengan nama <code>WHATSAPP_API_URL</code> (opsional).</li>
                    </ol>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 