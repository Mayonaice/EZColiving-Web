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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Reset button styling */
        button {
            background: none;
            border: none;
            font: inherit;
            margin: 0;
            padding: 0;
            align-items: center;
            height: 100%;
            display: inline-flex;
        }
        
        /* Dropdown button styling */
        .nav-dropdown-btn {
            padding-top: 0.25rem;
            padding-bottom: 0.25rem;
            border-bottom-width: 2px;
            line-height: 1.25rem;
            display: inline-flex;
            align-items: center;
            height: 100%;
            border-bottom-style: solid;
        }

        /* Dropdown menu styling */
        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 50;
            min-width: 12rem;
            padding: 0.5rem 0;
            margin-top: 0.125rem;
            background-color: white;
            border-radius: 0.375rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            opacity: 0;
            visibility: hidden;
            transition: all 200ms ease-in-out;
        }

        .group:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
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
                        
                        <!-- Master Data Dropdown -->
                        <div class="hidden sm:flex sm:-my-px sm:ml-10 relative group">
                            <button type="button" class="nav-dropdown-btn px-1 border-b-2 {{ request()->routeIs('admin.rooms.*') || request()->routeIs('admin.masterpayments.*') ? 'border-green-700' : 'border-green-400' }} text-sm font-medium text-gray-900 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out">
                                Master Data
                                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="dropdown-menu">
                                <div class="py-1">
                                    <a href="{{ route('admin.rooms.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.rooms.*') ? 'bg-green-50 text-green-700' : '' }}">
                                        Kamar
                                    </a>
                                    <a href="{{ route('admin.masterpayments.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.masterpayments.*') ? 'bg-green-50 text-green-700' : '' }}">
                                        Payment Method
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('admin.denah') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.denah') ? 'border-green-700' : 'border-green-400' }} text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out">
                                Denah
                            </a>
                        </div>

                        <!-- Booking Data Dropdown -->
                        <div class="hidden sm:flex sm:-my-px sm:ml-10 relative group">
                            <button type="button" class="nav-dropdown-btn px-1 border-b-2 {{ request()->routeIs('admin.payments.*') || request()->routeIs('admin.bookings.*') ? 'border-green-700' : 'border-green-400' }} text-sm font-medium text-gray-900 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out">
                                Booking Data
                                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="dropdown-menu">
                                <div class="py-1">
                                    <a href="{{ route('admin.payments.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.payments.*') ? 'bg-green-50 text-green-700' : '' }}">
                                        Confirm Payment
                                    </a>
                                    <a href="{{ route('admin.bookings.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.bookings.*') ? 'bg-green-50 text-green-700' : '' }}">
                                        History
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Finance Dropdown -->
                        <div class="hidden sm:flex sm:-my-px sm:ml-10 relative group">
                            <button type="button" class="nav-dropdown-btn px-1 border-b-2 {{ request()->routeIs('admin.expenses.*') || request()->routeIs('admin.reports.*') ? 'border-green-700' : 'border-green-400' }} text-sm font-medium text-gray-900 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out">
                                Finance
                                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="dropdown-menu">
                                <div class="py-1">
                                    <a href="{{ route('admin.expenses.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.expenses.*') ? 'bg-green-50 text-green-700' : '' }}">
                                        Pengeluaran
                                    </a>
                                    <a href="{{ route('admin.expense-categories.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.expense-categories.*') ? 'bg-green-50 text-green-700' : '' }}">
                                        Kategori Pengeluaran
                                    </a>
                                    <a href="{{ route('admin.reports.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('admin.reports.*') ? 'bg-green-50 text-green-700' : '' }}">
                                        Laporan
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('admin.settings.whatsapp') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.settings.whatsapp') ? 'border-green-700' : 'border-green-400' }} text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out">
                                WhatsApp Settings
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
                    
                    <!-- Mobile Master Data Menu -->
                    <div class="space-y-1">
                        <div class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('admin.rooms.*') || request()->routeIs('admin.masterpayments.*') ? 'border-green-700 text-green-700 bg-green-50' : 'border-transparent text-gray-600' }} text-base font-medium">
                            Master Data
                        </div>
                        <a href="{{ route('admin.rooms.index') }}" class="block pl-6 pr-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            Kamar
                        </a>
                        <a href="{{ route('admin.masterpayments.index') }}" class="block pl-6 pr-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            Payment Method
                        </a>
                    </div>

                    <!-- Mobile Booking Data Menu -->
                    <div class="space-y-1">
                        <div class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('admin.payments.*') || request()->routeIs('admin.bookings.*') ? 'border-green-700 text-green-700 bg-green-50' : 'border-transparent text-gray-600' }} text-base font-medium">
                            Booking Data
                        </div>
                        <a href="{{ route('admin.payments.index') }}" class="block pl-6 pr-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            Confirm Payment
                        </a>
                        <a href="{{ route('admin.bookings.index') }}" class="block pl-6 pr-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            History
                        </a>
                    </div>

                    <!-- Mobile Finance Menu -->
                    <div class="space-y-1">
                        <div class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('admin.expenses.*') || request()->routeIs('admin.reports.*') ? 'border-green-700 text-green-700 bg-green-50' : 'border-transparent text-gray-600' }} text-base font-medium">
                            Finance
                        </div>
                        <a href="{{ route('admin.expenses.index') }}" class="block pl-6 pr-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            Pengeluaran
                        </a>
                        <a href="{{ route('admin.expense-categories.index') }}" class="block pl-6 pr-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            Kategori Pengeluaran
                        </a>
                        <a href="{{ route('admin.reports.index') }}" class="block pl-6 pr-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                            Laporan
                        </a>
                    </div>

                    <a href="{{ route('admin.settings.whatsapp') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('admin.settings.whatsapp') ? 'border-green-700 text-green-700 bg-green-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium focus:outline-none focus:text-green-800 focus:bg-green-100 focus:border-green-700 transition duration-150 ease-in-out">
                        WhatsApp Settings
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
    
    @stack('scripts')
</body>
</html> 