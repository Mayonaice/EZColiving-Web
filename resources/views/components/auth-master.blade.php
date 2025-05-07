<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-green-50 to-cream-50">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-green-600 mb-2">Ez Coliving</h1>
                <p class="text-gray-600">Selamat Datang di Admin EZ Coliving</p>
            </div>

            @yield('content')

            <div class="mt-6 text-center text-sm text-gray-600">
                &copy; {{ date('Y') }} Ez Coliving. All rights reserved.
            </div>
        </div>
    </div>

    <style>
        .bg-gradient-to-br {
            background: linear-gradient(135deg, #f0fdf4 0%, #fefce8 100%);
        }
        .text-green-600 {
            color: #16a34a;
        }
        .from-green-50 {
            --tw-gradient-from: #f0fdf4;
        }
        .to-cream-50 {
            --tw-gradient-to: #fefce8;
        }
        input:focus {
            border-color: #16a34a;
            box-shadow: 0 0 0 1px #16a34a;
        }
        .btn-primary {
            background-color: #16a34a;
        }
        .btn-primary:hover {
            background-color: #15803d;
        }
        a {
            color: #16a34a;
        }
        a:hover {
            color: #15803d;
        }
    </style>
</body>
</html> 