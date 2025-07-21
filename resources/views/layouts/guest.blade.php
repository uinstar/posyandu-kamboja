<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Posyandu Kamboja</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-6">
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('bg/logo1.png') }}" class="w-20 h-20 mb-2 rounded-full" alt="Logo Posyandu">
            <h1 class="text-2xl font-bold text-green-700">Posyandu Kamboja</h1>
            <p class="text-sm text-gray-500">Silakan masuk ke sistem</p>
        </div>

        {{ $slot }} {{-- <== Ini yang menampilkan form login --}}
    </div>
</div>

    </body>
</html>
