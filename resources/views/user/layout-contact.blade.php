<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <title>Ez Coliving - Hubungi Kami</title>
    @vite(['resources/css/app.css', 'resources/css/tiny-screen.css', 'resources/js/app.js', 'resources/js/responsive-helpers.js'])
</head>

<body class="bg-gradient-to-b from-white to-gray-100">
    <div class="flex flex-col min-h-screen">
        <!-- Navbar -->
        <nav class="bg-white shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('userhome') }}" class="text-xl font-semibold text-gray-700">Ez Coliving.</a>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <a href="{{ route('login') }}"
                            class="h-10 w-10 flex justify-center items-center rounded-full cursor-pointer bg-gray-200/40 border-2 border-gray-300 text-gray-700 hover:duration-300 hover:ease-linear hover:text-white hover:bg-green-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-200 py-10 mt-auto">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-2">
                        <a href="{{ route('userhome') }}" class="inline-flex items-center">
                            <span class="text-xl font-bold tracking-wide text-gray-800 uppercase">Ez Coliving.</span>
                        </a>
                        <p class="mt-4 text-sm text-gray-600">
                            Ez Coliving menyediakan solusi hunian modern yang nyaman dan terjangkau untuk para profesional muda dan mahasiswa.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-base font-bold tracking-wide text-gray-900">Kontak</h3>
                        <div class="mt-2 space-y-2">
                            <p class="text-sm text-gray-600">Telepon: +62 856-9222-5216</p>
                            <p class="text-sm text-gray-600">Email: ezcoliving@gmail.com</p>
                            <p class="text-sm text-gray-600">Alamat: Jl Mangga Besar 4F No 5A, Jakarta Barat</p>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-base font-bold tracking-wide text-gray-900">Navigasi</h3>
                        <div class="mt-2 space-y-2">
                            <p><a href="{{ route('userhome') }}" class="text-sm text-gray-600 hover:text-green-700">Beranda</a></p>
                            <p><a href="{{ route('user.rooms.index') }}" class="text-sm text-gray-600 hover:text-green-700">Kamar</a></p>
                            <p><a href="{{ route('user.bookings.history') }}" class="text-sm text-gray-600 hover:text-green-700">Riwayat</a></p>
                            <p><a href="{{ route('user.about') }}" class="text-sm text-gray-600 hover:text-green-700">Kontak</a></p>
                        </div>
                    </div>
                </div>
                <div class="mt-8 border-t border-gray-300 pt-6 flex flex-col sm:flex-row justify-between">
                    <p class="text-sm text-gray-600">© Copyright 2025 Ez Coliving.</p>
                    <div class="mt-4 sm:mt-0">
                        <a href="/" class="text-sm text-gray-600 hover:text-green-700 mr-4">Privacy Policy</a>
                        <a href="/" class="text-sm text-gray-600 hover:text-green-700">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>

</html> 