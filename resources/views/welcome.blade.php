<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Posyandu Kamboja</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
               
            </style>
        @endif
    </head>
    <body>
        <div class="text-center py-10 bg-gradient-to-r from-green-200 to-blue-800">
     <h1 class="text-4xl font-bold text-gray-800">Selamat Datang di Website Posyandu</h1>
    <p class="mt-4 text-lg text-gray-700">Pantau data balita, ibu hamil, lansia, dan jadwal kegiatan secara mudah.</p>
    </div>

    </body>
</html>
