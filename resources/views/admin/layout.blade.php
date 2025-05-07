<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <nav class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('admin.rooms.index') }}" class="text-xl font-bold text-green-600">
                                Ez Coliving Admin
                            </a>
                        </div>

                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('admin.home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.home') ? 'border-green-700' : 'border-green-400' }} text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out">
                                Dashboard
                            </a>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('admin.rooms.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.rooms.*') ? 'border-green-700' : 'border-green-400' }} text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out">
                                Kamar
                            </a>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('admin.masterpayments.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.masterpayments.*') ? 'border-green-700' : 'border-green-400' }} text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out">
                                Metode Pembayaran
                            </a>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('admin.denah') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.denah') ? 'border-green-700' : 'border-green-400' }} text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out">
                                Denah Kamar
                            </a>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('admin.payments.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.payments.*') ? 'border-green-700' : 'border-green-400' }} text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out">
                                Confirm Pembayaran
                            </a>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.bookings.*') ? 'border-green-700' : 'border-green-400' }} text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out">
                                Riwayat Pemesanan
                            </a>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('admin.settings.whatsapp') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.settings.*') ? 'border-green-700' : 'border-green-400' }} text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out">
                                Pengaturan WhatsApp
                            </a>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="flex items-center sm:hidden">
                        <button id="menuButton" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path id="menuIcon" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path id="closeIcon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-gray-500 hover:text-gray-700">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobileMenu" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('admin.home') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('admin.home') ? 'border-green-700 text-green-700 bg-green-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition duration-150 ease-in-out">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.rooms.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('admin.rooms.*') ? 'border-green-700 text-green-700 bg-green-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition duration-150 ease-in-out">
                        Kamar
                    </a>
                    <a href="{{ route('admin.masterpayments.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('admin.masterpayments.*') ? 'border-green-700 text-green-700 bg-green-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition duration-150 ease-in-out">
                        Metode Pembayaran
                    </a>
                    <a href="{{ route('admin.denah') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('admin.denah') ? 'border-green-700 text-green-700 bg-green-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition duration-150 ease-in-out">
                        Denah Kamar
                    </a>
                    <a href="{{ route('admin.payments.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('admin.payments.*') ? 'border-green-700 text-green-700 bg-green-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition duration-150 ease-in-out">
                        Confirm Pembayaran
                    </a>
                    <a href="{{ route('admin.bookings.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('admin.bookings.*') ? 'border-green-700 text-green-700 bg-green-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition duration-150 ease-in-out">
                        Riwayat Pemesanan
                    </a>
                    <a href="{{ route('admin.settings.whatsapp') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('admin.settings.*') ? 'border-green-700 text-green-700 bg-green-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition duration-150 ease-in-out">
                        Pengaturan WhatsApp
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="block pl-3 pr-4 py-2">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-800 font-medium">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    @yield('header')
                </h2>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('menuButton');
            const mobileMenu = document.getElementById('mobileMenu');
            const menuIcon = document.getElementById('menuIcon');
            const closeIcon = document.getElementById('closeIcon');
            
            menuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                menuIcon.classList.toggle('hidden');
                menuIcon.classList.toggle('inline-flex');
                closeIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('inline-flex');
            });
        });
    </script>
</body>
</html> 