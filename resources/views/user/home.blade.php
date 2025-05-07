@extends('user.layout')

@section('content')

    <head>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .tooltip {
                opacity: 0;
                transform: translateX(10px);
                transition: opacity 0.3s, transform 0.3s;
            }

            .group:hover .tooltip {
                opacity: 1;
                transform: translateX(0);
            }

            html,
            body {
                max-width: 100%;
                overflow-x: hidden;
            }
        </style>
        <script src="{{ asset('js/user-landing-page.js') }}"></script>
    </head>

    <div class="fixed bottom-6 right-6 flex flex-col space-y-4 z-30">
        <a href="#top" class="group" data-turbolinks="false">
            <div class="relative flex items-center">
                <span
                    class="tooltip absolute right-14 bg-gray-800 text-white text-sm rounded-lg px-3 py-1 whitespace-nowrap">Home</span>
                <div
                    class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center shadow-lg hover:bg-green-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white"
                        class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9m0 0l9 9m-9-9v18" />
                    </svg>
                </div>
            </div>
        </a>
        <a href="#advantages" class="group">
            <div class="relative flex items-center">
                <span
                    class="tooltip absolute right-14 bg-gray-800 text-white text-sm rounded-lg px-3 py-1 whitespace-nowrap">Advantages</span>
                <div
                    class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center shadow-lg hover:bg-green-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="white" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>

                </div>
            </div>
        </a>
        <a href="#faq" class="group">
            <div class="relative flex items-center">
                <span
                    class="tooltip absolute right-14 bg-gray-800 text-white text-sm rounded-lg px-3 py-1 whitespace-nowrap">FAQ</span>
                <div
                    class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center shadow-lg hover:bg-green-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="white" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                    </svg>

                </div>
            </div>
        </a>
    </div>

    <div id="top" class="">
        <div style="background-image: url('/banner/ezco-banner.png')" class="bg-cover bg-center border-r-0 w-full h-screen">
            <div class="pt-16">

                <div class="flex justify-center">
                    <h1
                        class="xsm:text-3xl xsm:font-semibold xsm:pr-0 font-raleway mt-[120px] text-white xl:p-0 xl:text-7xl xl:font-bold">
                        Selamat Datang di EZ Coliving</h1>
                </div>

                <div class="xsm:mx-[0px] xsm:pr-14 xsm:pl-12 xl:mx-[480px] xl:px-[0px] flex justify-center text-center">
                    <p
                        class="xsm:text-[12px] xsm:font-sans xsm:font-[80] xl:font-poppins mt-4 text-white lg:text-[20px] lg:font-extralight">
                        Ez Coliving adalah tempat yang sangat
                        nyaman sebagai tempat tinggal sementara anda, EZ Coliving menawarkan banyak kelebihan yang
                        kenyamanan
                        untuk anda. memiliki pelayanan yang diatas rata rata kost pada umumnya, kami menunggu anda.</p>
                </div>

                <div class="flex justify-center xsm:pr-2 xl:pr-24 mt-6 xl:mx-[480px] text-center">
                    <a href="#advantages"
                        class="relative inline-flex items-center justify-center p-8 px-10 py-4 overflow-hidden font-medium text-teal-700 transition duration-300 ease-out rounded-full shadow-xl group hover:ring-1 hover:ring-emerald-500">
                        <span
                            class="absolute inset-0 w-full h-full bg-gradient-to-br from-teal-700 via-emerald-600 to-green-700"></span>
                        <span
                            class="absolute bottom-0 right-0 block w-[282px] h-[284px] mb-32 mr-4 transition duration-500 origin-bottom-left transform rotate-45 translate-x-24 bg-green-500 rounded-full opacity-30 group-hover:rotate-[110deg] ease"></span>
                        <span class="relative text-white">Pelajari Lebih Lanjut</span>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <section id="advantages"
        class="py-12 bg-gradient-to-tl from-orange-100 to-[#d3c8b8] text-gray-100 xsm:py-8 lg:py-16 w-full mt-[-16px]">

        <div class="px-4 mx-auto max-w-7xl xsm:px-6 lg:px-8">
            <div class="max-w-xl mx-auto text-center xl:max-w-2xl">
                <h2 class="text-3xl font-raleway font-bold leading-tight text-gray-50 xsm:text-4xl xl:text-5xl mb-6">Kenapa
                    kamu harus pilih EZ Coliving?</h2>
                <p class="mb-4">EZ Coliving adalah kost yang memiliki pelayanan yang sangat baik dan memiliki lingkungan
                    yang kondusif serta banyak kelebihan lainnya yang sudah di detailkan dibawah.</p>

            </div>

            <article x-data="slider" @touchstart="handleTouchStart" @touchmove="handleTouchMove"
                @touchend="handleTouchEnd" @mousedown="handleMouseDown" @mousemove="handleMouseMove"
                @mouseup="handleMouseUp"
                class="mt-12 relative w-full flex flex-shrink-0 overflow-hidden shadow-2xl select-none">

                <div class="rounded-full bg-gray-600 text-white absolute top-5 right-5 text-sm px-2 text-center z-10">
                    <span x-text="currentIndex"></span>/<span x-text="images.length"></span>
                </div>

                <template x-for="(image, idx) in images" :key="idx">
                    <figure class="h-[420px] w-full flex-shrink-0 flex justify-center items-center"
                        x-show="currentIndex === idx + 1" x-transition:enter="transition transform duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="transition transform duration-300" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0">
                        <img :src="image" alt="Image"
                            class="absolute inset-0 z-10 h-full w-full object-cover opacity-70" />
                        <figcaption
                            class="absolute inset-x-0 bottom-1 z-20 w-96 mx-auto p-4 font-light text-sm text-center tracking-widest leading-snug bg-gray-300 bg-opacity-25">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                        </figcaption>
                    </figure>
                </template>

                <button @click="back()"
                    class="absolute left-14 top-1/2 -translate-y-1/2 w-11 h-11 flex justify-center items-center rounded-full shadow-md z-10 bg-gray-100 hover:bg-gray-200">
                    <svg class="w-8 h-8 text-gray-500 hover:text-gray-600 hover:-translate-x-0.5 transition duration-500"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <button @click="next()"
                    class="absolute right-14 top-1/2 -translate-y-1/2 w-11 h-11 flex justify-center items-center rounded-full shadow-md z-10 bg-gray-100 hover:bg-gray-200">
                    <svg class="w-8 h-8 text-gray-500 hover:text-gray-600 hover:translate-x-0.5 transition duration-500"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

            </article>

            <div
                class="grid max-w-4xl lg:max-w-6xl grid-cols-1 mx-auto mt-8 text-center gap-y-4 xsm:gap-x-8 xsm:grid-cols-1 lg:grid-cols-3 xsm:mt-12 lg:mt-20 xsm:text-left">
                <div class="relative">
                    <div class="absolute -inset-1">
                        <div
                            class="w-full h-full rotate-180 opacity-30 blur-lg filter bg-gradient-to-r from-yellow-200 via-pink-500 to-white">
                        </div>
                    </div>
                    <div class="relative overflow-hidden bg-white shadow-md rounded-xl h-full">
                        <div class="p-9"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="black" class="size-[42px]">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                            </svg>
                            <h3 class="mt-6 text-2xl font-raleway font-bold text-gray-900 xsm:mt-10">Tes 1</h3>
                            <p class="mt-6 text-base text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing
                                elit. Quisquam sit consectetur quo unde consequatur fuga animi reiciendis velit ea
                                repellendus!</p>
                        </div>
                    </div>
                </div>
                <div class="overflow-hidden bg-white shadow-md rounded-xl">
                    <div class="p-9"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="black" class="size-[42px]">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                        </svg>
                        <h3 class="mt-6 text-2xl font-raleway font-bold text-gray-900 xsm:mt-10">Tes 2</h3>
                        <p class="mt-6 text-base text-gray-600">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                            Placeat quod, aperiam accusamus deserunt dicta ullam eveniet nihil minima. Odio, ad dignissimos!
                        </p>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -inset-1">
                        <div
                            class="w-full h-full rotate-180 opacity-30 blur-lg filter bg-gradient-to-r from-yellow-200 via-pink-500 to-white">
                        </div>
                    </div>
                    <div class="relative overflow-hidden bg-white shadow-md rounded-xl h-full">
                        <div class="p-9"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="black" class="size-[42px]">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                            </svg>
                            <h3 class="mt-6 text-2xl font-raleway font-bold text-gray-900 xsm:mt-10">Tes 3</h3>
                            <p class="mt-6 text-base text-gray-600">Lorem, ipsum dolor sit amet consectetur adipisicing
                                elit. Tenetur temporibus asperiores vero quasi qui quo fugiat, cumque accusamus?</p>
                        </div>
                    </div>
                </div>
                <div class="overflow-hidden bg-white shadow-md rounded-xl">
                    <div class="p-9"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="black" class="size-[42px]">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                        </svg>
                        <h3 class="mt-6 text-2xl font-raleway font-bold text-gray-900 xsm:mt-10">Tes 4</h3>
                        <p class="mt-6 text-base text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Nulla quaerat numquam ratione quam, perspiciatis deleniti totam alias excepturi qui, magni
                            voluptatibus voluptas reprehenderit.</p>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -inset-1">
                        <div
                            class="w-full h-full rotate-180 opacity-30 blur-lg filter bg-gradient-to-r from-yellow-200 via-pink-500 to-white">
                        </div>
                    </div>
                    <div class="relative overflow-hidden bg-white shadow-md rounded-xl h-full">
                        <div class="p-9"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="black" class="size-[42px]">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                            </svg>

                            <h3 class="mt-6 text-2xl font-raleway font-bold text-gray-900 xsm:mt-10">Tes 5
                            </h3>
                            <p class="mt-6 text-base text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing
                                elit. Nemo veniam sequi doloribus est magni placeat repudiandae quibusdam laborum esse.</p>
                        </div>
                    </div>
                </div>
                <div class="overflow-hidden bg-white shadow-md rounded-xl">
                    <div class="p-9"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="black" class="size-[42px]">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                        </svg>
                        <h3 class="mt-6 text-2xl font-raleway font-bold text-gray-900 xsm:mt-10">Tes 6</h3>
                        <p class="mt-6 text-base text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Id, corrupti. Neque necessitatibus ducimus nam odio atque, optio dolor perspiciatis laborum
                            voluptates reprehenderit deleniti quidem eius odit temporibus.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <main id="faq" class="p-5 bg-light-blue">
        <div class="flex justify-center items-start my-2">
            <div class="w-full xsm:w-10/12 md:w-1/2 my-1">
                <h2 class="text-xl font-raleway font-semibold text-vnet-blue mb-2">FAQ - Pertanyaan Umum</h2>
                <ul class="flex flex-col">
                    <li class="bg-white my-2 shadow-lg" x-data="accordion(1)">
                        <h2 @click="handleClick()"
                            class="flex flex-row justify-between items-center font-raleway font-semibold p-3 cursor-pointer">
                            <span>Tes 1</span>
                            <svg :class="handleRotate()"
                                class="fill-current text-green-700 h-6 w-6 transform transition-transform duration-500"
                                viewBox="0 0 20 20">
                                <path
                                    d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                </path>
                            </svg>
                        </h2>
                        <div x-ref="tab" :style="handleToggle()"
                            class="border-l-2 border-green-600 overflow-hidden max-h-0 duration-500 transition-all">
                            <p class="p-3 text-gray-900">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsam eligendi tempore quibusdam
                                quia possimus. Facere, doloremque dolor. Magnam, minima quod rerum laboriosam ut commodi
                                incidunt vero voluptatem, ratione et, vel ex asperiores saepe sed consequuntur deserunt
                                aliquid voluptates laudantium quasi dignissimos beatae! Quod, beatae.
                            </p>
                        </div>
                    </li>
                    <li class="bg-white my-2 shadow-lg" x-data="accordion(2)">
                        <h2 @click="handleClick()"
                            class="flex flex-row justify-between items-center font-raleway font-semibold p-3 cursor-pointer">
                            <span>Tes 2</span>
                            <svg :class="handleRotate()"
                                class="fill-current text-green-700 h-6 w-6 transform transition-transform duration-500"
                                viewBox="0 0 20 20">
                                <path
                                    d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                </path>
                            </svg>
                        </h2>
                        <div class="border-l-2 border-green-600 overflow-hidden max-h-0 duration-500 transition-all"
                            x-ref="tab" :style="handleToggle()">
                            <p class="p-3 text-gray-900">
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi, eius inventore. Maxime
                                nihil omnis recusandae adipisci reiciendis pariatur cumque dolor nesciunt necessitatibus
                                dolores voluptates, voluptas cum vel sequi, ut ipsum exercitationem autem delectus sed!
                                Dolores fugit nam nobis.
                            </p>
                        </div>
                    </li>
                    <li class="bg-white my-2 shadow-lg" x-data="accordion(3)">
                        <h2 @click="handleClick()"
                            class="flex flex-row justify-between items-center font-raleway font-semibold p-3 cursor-pointer">
                            <span>Tes 3</span>
                            <svg :class="handleRotate()"
                                class="fill-current text-green-700 h-6 w-6 transform transition-transform duration-500"
                                viewBox="0 0 20 20">
                                <path
                                    d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                </path>
                            </svg>
                        </h2>
                        <div class="border-l-2 border-green-600 overflow-hidden max-h-0 duration-500 transition-all"
                            x-ref="tab" :style="handleToggle()">
                            <p class="p-3 text-gray-900">
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi, eius inventore. Maxime
                                nihil omnis recusandae adipisci reiciendis pariatur cumque dolor nesciunt necessitatibus
                                dolores voluptates, voluptas cum vel sequi, ut ipsum exercitationem autem delectus sed!
                                Dolores fugit nam nobis.
                            </p>
                        </div>
                    </li>
                    <li class="bg-white my-2 shadow-lg" x-data="accordion(4)">
                        <h2 @click="handleClick()"
                            class="flex flex-row justify-between items-center font-raleway font-semibold p-3 cursor-pointer">
                            <span>Tes 4</span>
                            <svg :class="handleRotate()"
                                class="fill-current text-green-700 h-6 w-6 transform transition-transform duration-500"
                                viewBox="0 0 20 20">
                                <path
                                    d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10">
                                </path>
                            </svg>
                        </h2>
                        <div class="border-l-2 border-green-600 overflow-hidden max-h-0 duration-500 transition-all"
                            x-ref="tab" :style="handleToggle()">
                            <p class="p-3 text-gray-900">
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi, eius inventore. Maxime
                                nihil omnis recusandae adipisci reiciendis pariatur cumque dolor nesciunt necessitatibus
                                dolores voluptates, voluptas cum vel sequi, ut ipsum exercitationem autem delectus sed!
                                Dolores fugit nam nobis.
                            </p>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('slider', () => ({
                currentIndex: 1,
                images: [
                    '/banner/carousel/2th-floor-kitchen.jpeg',
                    '/banner/carousel/2th-floor-tables.jpeg',
                    '/banner/carousel/5th-floor-front.jpeg',
                    '/banner/carousel/5th-floor-side.jpeg',
                ],
                startX: 0,
                endX: 0,
                isDragging: false,
                isNavigating: false,

                back() {
                    if (this.isNavigating) return;
                    this.isNavigating = true;
                    this.currentIndex = this.currentIndex > 1 ? this.currentIndex - 1 : this.images
                        .length;
                    setTimeout(() => this.isNavigating = false, 300);
                },

                next() {
                    if (this.isNavigating) return;
                    this.isNavigating = true;
                    this.currentIndex = this.currentIndex < this.images.length ? this.currentIndex + 1 :
                        1;
                    setTimeout(() => this.isNavigating = false, 300);
                },

                handleTouchStart(event) {
                    this.startX = event.touches[0].clientX;
                    this.isDragging = true;
                },
                handleTouchMove(event) {
                    if (!this.isDragging) return;
                    this.endX = event.touches[0].clientX;
                },
                handleTouchEnd() {
                    this.isDragging = false;
                    this.detectSwipe();
                },

                handleMouseDown(event) {
                    this.startX = event.clientX;
                    this.isDragging = true;
                },
                handleMouseMove(event) {
                    if (!this.isDragging) return;
                    this.endX = event.clientX;
                },
                handleMouseUp() {
                    this.isDragging = false;
                    this.detectSwipe();
                },

                detectSwipe() {
                    const swipeDistance = this.startX - this.endX;
                    if (swipeDistance > 50) this.next();
                    else if (swipeDistance < -50) this.back();
                    this.startX = 0;
                    this.endX = 0;
                },
            }));
        });

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
@endsection
