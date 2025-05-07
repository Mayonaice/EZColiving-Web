@extends('user.layout')

@section('content')
    <div class="w-full pt-20 pl-4 sm:pl-8 md:pl-14 lg:pl-20 pr-4 sm:pr-8 lg:pr-20">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Hubungi Kami</h1>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">Temukan informasi kontak dan lokasi Ez Coliving untuk
                    kebutuhan hunian Anda.</p>
                <div class="w-24 h-1 bg-green-600 mx-auto mt-6"></div>
            </div>

            <!-- Contact Info Section -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-16">
                <div class="grid md:grid-cols-2 gap-10">
                    <div class="flex flex-col justify-center">
                        <h2 class="text-3xl font-bold text-gray-800 mb-8">Informasi Kontak</h2>

                        <div class="space-y-6">
                            <a href="tel:+6285692225216">
                                <div class="flex items-start space-x-4 mb-4">
                                    <div class="bg-green-100 p-3 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">Telepon</h3>
                                        <p class="text-gray-600">+62 856-9222-5216</p>
                                        <p class="text-sm text-gray-500 mt-1">Senin - Minggu: 08.00 - 20.00 WIB</p>
                                    </div>
                                </div>
                            </a>

                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=ezcoliving@gmail.com" target="_blank">
                                <div class="flex items-start space-x-4 mb-4">
                                    <div class="bg-green-100 p-3 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">Email</h3>
                                        <p class="text-gray-600">ezcoliving@gmail.com</p>
                                        <p class="text-sm text-gray-500 mt-1">Kami akan merespon dalam 24 jam</p>
                                    </div>
                                </div>
                            </a>

                            <a href="https://maps.app.goo.gl/u43eVZ2aXzdbANfL9">
                                <div class="flex items-start space-x-4 mb-4">
                                    <div class="bg-green-100 p-3 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">Alamat</h3>
                                        <p class="text-gray-600">Jl Mangga Besar 4F No 5A</p>
                                        <p class="text-gray-600">Jakarta Barat, DKI Jakarta</p>
                                        <p class="text-sm text-gray-500 mt-1">Kode Pos: 11150</p>
                                    </div>
                                </div>
                            </a>

                            <a href="http://wa.me//6288809301155">
                                <div class="flex items-start space-x-4 mb-4">
                                    <div class="bg-green-100 p-3 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">WhatsApp</h3>
                                        <p class="text-gray-600">+62 856-9222-5216</p>
                                        <p class="text-sm text-gray-500 mt-1">Respon cepat untuk pertanyaan</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="rounded-lg overflow-hidden shadow-lg h-[400px]">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.8679400817785!2d106.82201361476894!3d-6.147530995551365!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5cae6eda631%3A0xb6a64117a10a69d!2sJl.%20Mangga%20Besar%204F%20No.5%2C%20RT.1%2FRW.2%2C%20Mangga%20Besar%2C%20Kecamatan%20Taman%20Sari%2C%20Kota%20Jakarta%20Barat%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2011150!5e0!3m2!1sid!2sid!4v1651321050983!5m2!1sid!2sid"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <!-- Jam Operasional -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Jam Operasional</h2>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-gray-200">
                        <div class="p-8">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Kantor Administrasi</h3>
                            <ul class="space-y-3">
                                <li class="flex justify-between">
                                    <span class="text-gray-600">Senin - Jumat</span>
                                    <span class="font-semibold">08:00 - 17:00 WIB</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-600">Sabtu</span>
                                    <span class="font-semibold">09:00 - 15:00 WIB</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="text-gray-600">Minggu</span>
                                    <span class="font-semibold">Tutup</span>
                                </li>
                            </ul>
                        </div>
                        <div class="p-8">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Penjagaan Keamanan</h3>
                            <ul class="space-y-3">
                                <li class="flex justify-between">
                                    <span class="text-gray-600">Senin - Minggu</span>
                                    <span class="font-semibold">24 Jam</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulir Kontak -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Kirim Pesan</h2>
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <form class="space-y-6 max-w-4xl mx-auto">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                    Lengkap</label>
                                <input type="text" id="name"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" id="email"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
                            </div>
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                Telepon</label>
                            <input type="tel" id="phone"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subjek</label>
                            <input type="text" id="subject"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                            <textarea id="message" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500"></textarea>
                        </div>
                        <div class="flex justify-center">
                            <button type="submit"
                                class="px-6 py-3 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 transition-colors">Kirim
                                Pesan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- FAQ -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Pertanyaan Umum</h2>
                <div class="space-y-4">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <button class="flex justify-between items-center w-full px-6 py-4 text-left"
                            onclick="toggleFaq(this)">
                            <span class="font-semibold text-gray-800">Bagaimana cara memesan kamar di Ez Coliving?</span>
                            <svg class="h-5 w-5 text-gray-500 transform transition-transform duration-200" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="hidden px-6 py-4 bg-gray-50 border-t border-gray-200">
                            <p class="text-gray-600">Anda dapat memesan kamar dengan mengunjungi halaman Kamar kami,
                                memilih kamar yang tersedia, dan mengikuti proses checkout. Atau Anda dapat menghubungi kami
                                langsung via WhatsApp untuk bantuan pemesanan.</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <button class="flex justify-between items-center w-full px-6 py-4 text-left"
                            onclick="toggleFaq(this)">
                            <span class="font-semibold text-gray-800">Berapa minimal masa tinggal di Ez Coliving?</span>
                            <svg class="h-5 w-5 text-gray-500 transform transition-transform duration-200" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="hidden px-6 py-4 bg-gray-50 border-t border-gray-200">
                            <p class="text-gray-600">Minimal masa tinggal adalah 1 bulan. Namun, kami menawarkan diskon
                                khusus untuk pemesanan dengan durasi lebih panjang.</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <button class="flex justify-between items-center w-full px-6 py-4 text-left"
                            onclick="toggleFaq(this)">
                            <span class="font-semibold text-gray-800">Apakah pembayaran bisa dicicil?</span>
                            <svg class="h-5 w-5 text-gray-500 transform transition-transform duration-200" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="hidden px-6 py-4 bg-gray-50 border-t border-gray-200">
                            <p class="text-gray-600">Ya, kami menyediakan opsi pembayaran cicilan untuk tenant dengan
                                durasi tinggal minimal 3 bulan. Silakan hubungi admin kami untuk informasi lebih lanjut.</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <button class="flex justify-between items-center w-full px-6 py-4 text-left"
                            onclick="toggleFaq(this)">
                            <span class="font-semibold text-gray-800">Fasilitas apa saja yang tersedia di Ez
                                Coliving?</span>
                            <svg class="h-5 w-5 text-gray-500 transform transition-transform duration-200" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="hidden px-6 py-4 bg-gray-50 border-t border-gray-200">
                            <p class="text-gray-600">Ez Coliving menyediakan berbagai fasilitas seperti WiFi kecepatan
                                tinggi, ruang komunal, dapur bersama, laundry, keamanan 24 jam, dan pembersihan area umum
                                rutin.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mencegah footer dari ditampilkan di jalur normal -->
    <style>
        .min-h-full.w-full.flex.flex-wrap.items-start>div.xsm\:mt-12 {
            display: none !important;
        }
    </style>

    <!-- Footer Manual -->
    <div class="w-full bg-gray-200 pt-16 pb-8 px-4 md:px-12 lg:px-20 mt-10 border-t border-gray-300">
        <div class="max-w-6xl mx-auto">
            <div class="grid gap-10 row-gap-6 mb-8 xsm:grid-cols-2 lg:grid-cols-4">
                <div class="xsm:col-span-2">
                    <a href="{{ route('userhome') }}" class="inline-flex items-center">
                        <span class="text-xl font-bold tracking-wide text-gray-800 uppercase">Ez Coliving.</span>
                    </a>
                    <p class="mt-4 text-sm text-gray-600">
                        Ez Coliving menyediakan solusi hunian modern yang nyaman dan terjangkau untuk para profesional muda
                        dan mahasiswa.
                    </p>
                </div>
                <div class="space-y-2 text-sm">
                    <p class="text-base font-bold tracking-wide text-gray-900">Kontak</p>
                    <div class="flex">
                        <p class="mr-1 text-gray-800">Telepon:</p>
                        <a href="tel:856-9222-5216" class="text-gray-600 hover:text-green-700">+62 856-9222-5216</a>
                    </div>
                    <div class="flex">
                        <p class="mr-1 text-gray-800">Email:</p>
                        <a href="mailto:ezcoliving@gmail.com"
                            class="text-gray-600 hover:text-green-700">ezcoliving@gmail.com</a>
                    </div>
                    <div class="flex">
                        <p class="mr-1 text-gray-800">Alamat:</p>
                        <a href="https://maps.app.goo.gl/UB2H2aoGM8ob59dS6" class="text-gray-600 hover:text-green-700">
                            Jl Mangga Besar 4F No 5A
                        </a>
                    </div>
                </div>
                <div>
                    <p class="text-base font-bold tracking-wide text-gray-900">Navigasi</p>
                    <div class="mt-2 space-y-2">
                        <p><a href="{{ route('userhome') }}"
                                class="text-sm text-gray-600 hover:text-green-700">Beranda</a></p>
                        <p><a href="{{ route('user.rooms.index') }}"
                                class="text-sm text-gray-600 hover:text-green-700">Kamar</a></p>
                        <p><a href="{{ route('user.bookings.history') }}"
                                class="text-sm text-gray-600 hover:text-green-700">Riwayat</a></p>
                        <p><a href="{{ route('user.about') }}"
                                class="text-sm text-gray-600 hover:text-green-700">Kontak</a></p>
                    </div>
                </div>
            </div>
            <div class="pt-5 border-t border-gray-300 sm:flex sm:justify-between">
                <p class="text-sm text-gray-600">© Copyright 2025 Ez Coliving.</p>
                <div class="mt-4 sm:mt-0">
                    <a href="/" class="text-sm text-gray-600 hover:text-green-700 mr-4">Privacy Policy</a>
                    <a href="/" class="text-sm text-gray-600 hover:text-green-700">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleFaq(element) {
            const content = element.nextElementSibling;
            const arrow = element.querySelector('svg');

            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                arrow.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                arrow.classList.remove('rotate-180');
            }
        }

        // Fade-in animation
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.bg-white');

            fadeElements.forEach(element => {
                element.style.opacity = '0';
                element.style.transition = 'opacity 0.5s ease-in-out, transform 0.5s ease-in-out';
                element.style.transform = 'translateY(20px)';
            });

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });

            fadeElements.forEach(element => {
                observer.observe(element);
            });
        });
    </script>
@endsection
