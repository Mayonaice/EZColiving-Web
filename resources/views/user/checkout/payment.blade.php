@extends('user.layout')

@section('content')
<div class="container mx-auto px-4 py-8 mt-16">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gray-800 text-white px-6 py-4">
                <h2 class="text-xl font-semibold">Pembayaran</h2>
            </div>

            <div class="p-6">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h5 class="text-lg font-semibold mb-4 text-gray-800">Detail Pemesanan</h5>
                        <div class="space-y-2">
                            <p class="text-gray-600">
                                <span class="font-medium">Nomor Pemesanan:</span> {{ $booking->booking_number }}
                            </p>
                            <p class="text-gray-600">
                                <span class="font-medium">Nama:</span> {{ $booking->name_booking }}
                            </p>
                            <p class="text-gray-600">
                                <span class="font-medium">Check-in:</span> {{ $booking->booking_date_in }}
                            </p>
                            <p class="text-gray-600">
                                <span class="font-medium">Check-out:</span> {{ $booking->booking_date_out }}
                            </p>
                            <p class="text-gray-600">
                                <span class="font-medium">Total:</span> Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h5 class="text-lg font-semibold mb-4 text-gray-800">Detail Pembayaran</h5>
                        <div class="space-y-2">
                            <p class="text-gray-600">
                                <span class="font-medium">Metode:</span> {{ $payment->payment_name }}
                            </p>
                            <p class="text-gray-600">
                                <span class="font-medium">Nomor Rekening:</span> {{ $payment->payment_number }}
                            </p>
                            <p class="text-gray-600">
                                <span class="font-medium">Total:</span> Rp {{ number_format($payment->payment_amount, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="text-center mb-8">
                    <h5 class="text-lg font-semibold mb-4 text-gray-800">QR Code Pembayaran</h5>
                    <div class="bg-white p-4 rounded-lg shadow-md inline-block">
                        @if(isset($masterPayment->payment_qrcode))
                        <img src="{{ asset('storage/masterpayments/' . $masterPayment->payment_qrcode) }}" 
                             alt="QR Code" 
                             class="w-48 h-48 object-contain mx-auto">
                        <p class="mt-2 text-gray-600">Scan QR code di atas untuk melakukan pembayaran</p>
                        @else
                        <div class="w-48 h-48 flex items-center justify-center border border-gray-200 rounded-md">
                            <p class="text-gray-500">QR Code tidak tersedia</p>
                        </div>
                        @endif
                    </div>
                </div>

                <form action="{{ route('user.checkout.upload-payment', $booking->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <label for="payment_image" class="block text-sm font-medium text-gray-700 mb-2">
                            Upload Bukti Pembayaran
                        </label>
                        <div class="mt-1 flex flex-col justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <div id="image-preview" class="hidden mx-auto mb-4">
                                    <img id="preview-image" src="#" alt="Preview" class="h-48 object-contain mx-auto rounded-md">
                                </div>
                                <svg id="upload-icon" class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="payment_image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload file</span>
                                        <input id="payment_image" name="payment_image" type="file" class="sr-only" required onchange="previewImage(this)">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG, JPEG sampai 2MB
                                </p>
                            </div>
                        </div>
                        @error('payment_image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-center">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Upload Bukti Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview-image');
    const previewContainer = document.getElementById('image-preview');
    const uploadIcon = document.getElementById('upload-icon');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
            uploadIcon.classList.add('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        previewContainer.classList.add('hidden');
        uploadIcon.classList.remove('hidden');
    }
}
</script>
@endsection 