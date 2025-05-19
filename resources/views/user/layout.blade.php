<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <title>Ez Coliving</title>
    @vite(['resources/css/app.css', 'resources/css/tiny-screen.css', 'resources/js/app.js', 'resources/js/responsive-helpers.js', 'resources/js/tiny-screen-slider.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Style untuk mendukung responsif layar kecil */
        @media (max-width: 320px) {
            html,
            body {
                overflow-x: hidden;
                width: 100%;
                min-width: 280px;
            }
            
            .xsm-text-center {
                text-align: center;
            }
            
            .xs-p-1 {
                padding: 0.25rem !important;
            }
            
            .xs-mx-1 {
                margin-left: 0.25rem !important;
                margin-right: 0.25rem !important;
            }
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body x-data="{ isLoginOpen: false, isRegisterOpen: false }">
    <div class="h-screen w-full bg-white relative flex overflow-hidden">

        <aside
            class="h-full xsm:w-10 xl:w-14 flex flex-col space-y-4 xl:space-y-10 items-center justify-center fixed z-[999] bg-gray-200/40 backdrop-blur-md text-gray-700">

            <a href="{{ route('userhome') }}">
            <div
                    class="relative group xsm:h-10 xsm:w-10 xl:h-14 xl:w-14 flex items-center justify-center rounded-lg cursor-pointer hover:text-white hover:bg-green-700 hover:duration-300 hover:ease-linear focus:bg-gray-500 {{ request()->routeIs('userhome') ? 'bg-green-700 text-white' : 'text-gray-700' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="xsm:size-5 xl:size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <span
                        class="absolute xsm:left-12 xl:left-16 bg-green-700 text-white px-2 py-1 text-sm rounded-lg opacity-0 transform -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">Home</span>
            </div>
            </a>

            <a href="{{ route('user.rooms.index') }}">
            <div
                    class="relative group xsm:h-10 xsm:w-10 xl:h-14 xl:w-14 flex items-center justify-center rounded-lg cursor-pointer hover:text-white hover:bg-green-700 hover:duration-300 hover:ease-linear focus:bg-gray-500 {{ request()->routeIs('user.rooms.*') ? 'bg-green-700 text-white' : 'text-gray-700' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="xsm:size-5 xl:size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                </svg>
                <span
                        class="absolute xsm:left-12 xl:left-16 bg-green-700 text-white px-2 py-1 text-sm rounded-lg opacity-0 transform -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">Kamar</span>
            </div>
            </a>

            <a href="{{ route('user.bookings.history') }}">
            <div
                    class="relative group xsm:h-10 xsm:w-10 xl:h-14 xl:w-14 flex items-center justify-center rounded-lg cursor-pointer hover:text-white hover:bg-green-700 hover:duration-300 hover:ease-linear focus:bg-gray-500 {{ request()->routeIs('user.bookings.*') ? 'bg-green-700 text-white' : 'text-gray-700' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="xsm:size-5 xl:size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V19.5a2.25 2.25 0 0 0 2.25 2.25h.75m9.75-9.75H18c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125v-9.75c0-.621.504-1.125 1.125-1.125h9.75Z" />
                </svg>
                <span
                        class="absolute xsm:left-12 xl:left-16 bg-green-700 text-white px-2 py-1 text-sm rounded-lg opacity-0 transform -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">Riwayat</span>
            </div>
            </a>

            <a href="{{ route('damages.index') }}">
            <div
                    class="relative group xsm:h-10 xsm:w-10 xl:h-14 xl:w-14 flex items-center justify-center rounded-lg cursor-pointer hover:text-white hover:bg-green-700 hover:duration-300 hover:ease-linear focus:bg-gray-500 {{ request()->routeIs('damages.*') ? 'bg-green-700 text-white' : 'text-gray-700' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="xsm:size-5 xl:size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                </svg>
                <span
                        class="absolute xsm:left-12 xl:left-16 bg-green-700 text-white px-2 py-1 text-sm rounded-lg opacity-0 transform -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">Kerusakan</span>
            </div>
            </a>

            <a href="{{ route('user.about') }}">
            <div
                    class="relative group xsm:h-10 xsm:w-10 xl:h-14 xl:w-14 flex items-center justify-center rounded-lg cursor-pointer hover:text-white hover:bg-green-700 hover:duration-300 hover:ease-linear focus:bg-gray-500 {{ request()->routeIs('user.about') ? 'bg-green-700 text-white' : 'text-gray-700' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="xsm:size-5 xl:size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                </svg>
                <span
                        class="absolute xsm:left-12 xl:left-16 bg-green-700 text-white px-2 py-1 text-sm rounded-lg opacity-0 transform -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">Contact</span>
            </div>
            </a>

        </aside>

        <div class="h-full flex-1 flex flex-col">
            <nav
                class="h-12 xl:h-16 w-full flex items-center justify-between fixed top-0 right-0 left-0 z-[1000] bg-gray-200/40 backdrop-blur-md border-b border-gray-200/50 pl-[2.5rem] pr-2 xsm:pr-4 xl:pr-16 xl:pl-14">

                <div class="flex flex-shrink-0 items-center">
                    <div class="xsm:text-md xl:text-xl font-semibold text-gray-700">Ez Coliving.</div>
                </div>

                <div class="flex flex-shrink-0 items-center">
                    <button @click="isLoginOpen = true"
                        class="h-8 w-8 xl:h-10 xl:w-10 flex justify-center items-center rounded-full cursor-pointer bg-gray-200/40 border-2 border-gray-300 text-gray-700 hover:duration-300 hover:ease-linear hover:text-white hover:bg-green-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </button>
                </div>
            </nav>

            <main class="flex-1 w-full overflow-x-hidden overflow-y-auto z-[998]">
                <div class="min-h-full w-full flex flex-wrap items-start rounded-tl grid-flow-col auto-cols-max gap-4">
                    @yield('content')

                    <div class="xsm:mt-12 xl:mt-28 bg-gray-200 px-4 pt-16 mx-auto w-full md:px-24 lg:px-8 ">
                        <div class="pl-12 grid gap-10 row-gap-6 mb-8 xsm:grid-cols-2 lg:grid-cols-4">
                            <div class="xsm:col-span-2">
                                <a href="/" aria-label="Go home" title="Company" class="inline-flex items-center">
                                    <svg class="w-8 text-deep-purple-accent-400" viewBox="0 0 24 24"
                                        stroke-linejoin="round" stroke-width="2" stroke-linecap="round"
                                        stroke-miterlimit="10" stroke="currentColor" fill="none">
                                        <rect x="3" y="1" width="7" height="12"></rect>
                                        <rect x="3" y="17" width="7" height="6"></rect>
                                        <rect x="14" y="1" width="7" height="6"></rect>
                                        <rect x="14" y="11" width="7" height="12"></rect>
                                    </svg>
                                    <span
                                        class="ml-2 text-xl font-raleway font-bold tracking-wide text-gray-800 uppercase">Ez
                                        Coliving.</span>
                                </a>
                                <div class="mt-6 lg:max-w-sm">
                                    <p class="text-sm text-gray-800">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat aliquam
                                        pariatur enim odit repellendus tenetur placeat asperiores nesciunt?
                                    </p>
                                    <p class="mt-4 text-sm text-gray-800">
                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maxime iste recusandae
                                        eveniet cupiditate placeat!
                                    </p>
                                </div>
                            </div>
                            <div class="space-y-2 text-sm">
                                <p class="text-base font-raleway font-bold tracking-wide text-gray-900">Contacts</p>
                                <div class="flex">
                                    <p class="mr-1 text-gray-800">Phone:</p>
                                    <a href="tel:856-9222-5216" aria-label="Our phone" title="Our phone"
                                        class="transition-colors duration-300 text-deep-purple-accent-400 hover:text-deep-purple-800">+62
                                        856-9222-5216</a>
                                </div>
                                <div class="flex">
                                    <p class="mr-1 text-gray-800">Email:</p>
                                    <a href="mailto:ezcoliving@gmail.com" aria-label="Our email" title="Our email"
                                        class="transition-colors duration-300 text-deep-purple-accent-400 hover:text-deep-purple-800">ezcoliving@gmail.com</a>
                                </div>
                                <div class="flex">
                                    <p class="mr-1 text-gray-800">Address:</p>
                                    <a href="https://maps.app.goo.gl/UB2H2aoGM8ob59dS6" target="_blank"
                                        rel="noopener noreferrer" aria-label="Our address" title="Our address"
                                        class="transition-colors duration-300 text-deep-purple-accent-400 hover:text-deep-purple-800">
                                        Jl Mangga Besar 4F No 5A
                                    </a>
                                </div>
                            </div>
                            <div>
                                <span
                                    class="text-base font-raleway font-bold tracking-wide text-gray-900">Social</span>
                                <div class="flex items-center mt-1 space-x-3">
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-400">
                                        <svg viewBox="0 0 24 24" fill="currentColor" class="h-5">
                                            <path
                                                d="M24,4.6c-0.9,0.4-1.8,0.7-2.8,0.8c1-0.6,1.8-1.6,2.2-2.7c-1,0.6-2,1-3.1,1.2c-0.9-1-2.2-1.6-3.6-1.6 c-2.7,0-4.9,2.2-4.9,4.9c0,0.4,0,0.8,0.1,1.1C7.7,8.1,4.1,6.1,1.7,3.1C1.2,3.9,1,4.7,1,5.6c0,1.7,0.9,3.2,2.2,4.1 C2.4,9.7,1.6,9.5,1,9.1c0,0,0,0,0,0.1c0,2.4,1.7,4.4,3.9,4.8c-0.4,0.1-0.8,0.2-1.3,0.2c-0.3,0-0.6,0-0.9-0.1c0.6,2,2.4,3.4,4.6,3.4 c-1.7,1.3-3.8,2.1-6.1,2.1c-0.4,0-0.8,0-1.2-0.1c2.2,1.4,4.8,2.2,7.5,2.2c9.1,0,14-7.5,14-14c0-0.2,0-0.4,0-0.6 C22.5,6.4,23.3,5.5,24,4.6z">
                                            </path>
                                        </svg>
                                    </a>
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-400">
                                        <svg viewBox="0 0 30 30" fill="currentColor" class="h-6">
                                            <circle cx="15" cy="15" r="4"></circle>
                                            <path
                                                d="M19.999,3h-10C6.14,3,3,6.141,3,10.001v10C3,23.86,6.141,27,10.001,27h10C23.86,27,27,23.859,27,19.999v-10   C27,6.14,23.859,3,19.999,3z M15,21c-3.309,0-6-2.691-6-6s2.691-6,6-6s6,2.691,6,6S18.309,21,15,21z M22,9c-0.552,0-1-0.448-1-1   c0-0.552,0.448-1,1-1s1,0.448,1,1C23,8.552,22.552,9,22,9z">
                                            </path>
                                        </svg>
                                    </a>
                                    <a href="/"
                                        class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-400">
                                        <svg viewBox="0 0 24 24" fill="currentColor" class="h-5">
                                            <path
                                                d="M22,0H2C0.895,0,0,0.895,0,2v20c0,1.105,0.895,2,2,2h11v-9h-3v-4h3V8.413c0-3.1,1.893-4.788,4.659-4.788 c1.325,0,2.463,0.099,2.795,0.143v3.24l-1.918,0.001c-1.504,0-1.795,0.715-1.795,1.763V11h4.44l-1,4h-3.44v9H22c1.105,0,2-0.895,2-2 V2C24,0.895,23.105,0,22,0z">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                                <p class="mt-4 text-sm text-gray-500">
                                    Bacon ipsum dolor amet short ribs pig sausage prosciutto chicken spare ribs salami.
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col-reverse justify-between pt-5 pb-10 border-t lg:flex-row">
                            <p class="text-sm text-gray-600">
                                © Copyright 2025 EZ Coliving.
                            </p>
                            <ul class="flex flex-col mb-3 space-y-2 lg:mb-0 xsm:space-y-0 xsm:space-x-5 xsm:flex-row">
                                <li>
                                    <a href="/"
                                        class="text-sm text-gray-600 transition-colors duration-300 hover:text-deep-purple-accent-400">F.A.Q</a>
                                </li>
                                <li>
                                    <a href="/"
                                        class="text-sm text-gray-600 transition-colors duration-300 hover:text-deep-purple-accent-400">Privacy
                                        Policy</a>
                                </li>
                                <li>
                                    <a href="/"
                                        class="text-sm text-gray-600 transition-colors duration-300 hover:text-deep-purple-accent-400">Terms
                                        &amp; Conditions</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <!-- Login Modal -->
    <div x-cloak x-show="isLoginOpen" class="fixed inset-0 z-[1001] overflow-y-auto" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" 
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" 
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        <div class="flex min-h-screen items-center justify-center px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-900 bg-opacity-85 backdrop-blur-sm"></div>
            </div>
            <div @click.away="isLoginOpen = false"
                class="relative inline-block transform overflow-hidden rounded-2xl bg-white text-left align-bottom shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md sm:align-middle">
                <div class="absolute right-4 top-4">
                    <button @click="isLoginOpen = false" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="bg-white px-8 pt-8 pb-6">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 font-raleway">Selamat Datang Kembali Admin EZ Coliving</h3>
                        <p class="mt-2 text-sm text-gray-500">Silakan masuk ke akun admin Anda</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-green-500"></i>
                                </div>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                    class="block w-full pl-10 pr-3 py-3 border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm transition duration-150 ease-in-out"
                                    placeholder="Masukkan nama Anda">
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-green-500"></i>
                                </div>
                                <input id="password" type="password" name="password" required
                                    class="block w-full pl-10 pr-10 py-3 border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm transition duration-150 ease-in-out"
                                    placeholder="••••••••">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i id="password-icon"
                                        class="fas fa-eye text-gray-400 cursor-pointer hover:text-gray-600 transition-colors duration-200"
                                        onclick="togglePasswordVisibility('password')"></i>
                                </div>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out transform hover:scale-[1.02]">
                                Masuk
                            </button>
                        </div>

                        <div class="text-center">
                            <p class="text-sm text-gray-500">
                                Belum punya akun?
                                <button type="button" @click="isLoginOpen = false; isRegisterOpen = true"
                                    class="font-medium text-green-600 hover:text-green-700 transition-colors duration-200">
                                    Daftar sekarang
                                </button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

    <!-- Register Modal -->
    <div x-cloak x-show="isRegisterOpen" class="fixed inset-0 z-[1001] overflow-y-auto"
        x-transition:enter="transition ease-out duration-300" 
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" 
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" 
        x-transition:leave-end="opacity-0">
        <div class="flex min-h-screen items-center justify-center px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-900 bg-opacity-85 backdrop-blur-sm"></div>
            </div>
            <div @click.away="isRegisterOpen = false"
                class="relative inline-block transform overflow-hidden rounded-2xl bg-white text-left align-bottom shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md sm:align-middle">
                <div class="absolute right-4 top-4">
                    <button @click="isRegisterOpen = false" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="bg-white px-8 pt-8 pb-6">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 font-raleway">Buat Akun Admin Baru</h3>
                        <p class="mt-2 text-sm text-gray-500">Ingin membuat akun admin untuk mengurus administrasi? Hubungi admin nya terlebih dahulu yaa untuk kode rahasianya!</p>
                    </div>
                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf
                        <!-- Name -->
                        <div>
                            <label for="reg-name" class="block text-sm font-medium text-gray-700">Nama</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-green-500"></i>
                                </div>
                                <input id="reg-name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                    class="block w-full pl-10 pr-3 py-3 border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm transition duration-150 ease-in-out"
                                    placeholder="Masukkan nama Anda">
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Secret Code -->
                        <div>
                            <label for="secret_code" class="block text-sm font-medium text-gray-700">Kode Rahasia</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-key text-green-500"></i>
                                </div>
                                <input id="secret_code" type="password" name="secret_code" required
                                    class="block w-full pl-10 pr-10 py-3 border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm transition duration-150 ease-in-out"
                                    placeholder="••••••••">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i id="secret-code-icon"
                                        class="fas fa-eye text-gray-400 cursor-pointer hover:text-gray-600 transition-colors duration-200"
                                        onclick="togglePasswordVisibility('secret_code')"></i>
                                </div>
                            </div>
                            @error('secret_code')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="reg-password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-green-500"></i>
                                </div>
                                <input id="reg-password" type="password" name="password" required
                                    class="block w-full pl-10 pr-10 py-3 border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm transition duration-150 ease-in-out"
                                    placeholder="••••••••">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i id="reg-password-icon"
                                        class="fas fa-eye text-gray-400 cursor-pointer hover:text-gray-600 transition-colors duration-200"
                                        onclick="togglePasswordVisibility('reg-password')"></i>
                                </div>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-green-500"></i>
                                </div>
                                <input id="password_confirmation" type="password" name="password_confirmation" required
                                    class="block w-full pl-10 pr-10 py-3 border-gray-300 rounded-xl shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm transition duration-150 ease-in-out"
                                    placeholder="••••••••">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i id="password-confirmation-icon"
                                        class="fas fa-eye text-gray-400 cursor-pointer hover:text-gray-600 transition-colors duration-200"
                                        onclick="togglePasswordVisibility('password_confirmation')"></i>
                                </div>
                            </div>
                            @error('password_confirmation')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out transform hover:scale-[1.02]">
                                Daftar
                            </button>
                        </div>

                        <div class="text-center">
                            <p class="text-sm text-gray-500">
                                Sudah punya akun?
                                <button type="button" @click="isRegisterOpen = false; isLoginOpen = true"
                                    class="font-medium text-green-600 hover:text-green-700 transition-colors duration-200">
                                    Masuk sekarang
                                </button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId) {
            const passwordInput = document.getElementById(inputId);
            const passwordIcon = document.getElementById(inputId + '-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }
    </script>

    @stack('scripts')
</body>

</html>
