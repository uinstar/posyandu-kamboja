@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<div class="relative w-full min-h-screen bg-cover bg-center bg-no-repeat text-white flex items-center"
     style="background-image: url('/bg/cover.jpeg');">
    <!-- Overlay jika ingin membuat teks lebih terbaca -->
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>

    <!-- Content -->
    <div class="relative z-10 w-full px-6 lg:px-16 pt-0">
        <div class="max-w-4xl">
            <!-- Icon -->
            <div class="mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white bg-opacity-20 backdrop-blur-sm rounded-full mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Headline -->
            <h2 class="text-6xl md:text-6xl font-bold mb-6 leading-tight">
                Selamat Datang di<br>
                <span class="bg-gradient-to-r from-green-400 to-green-700 bg-clip-text text-transparent">
                    Posyandu Kamboja
                </span>
            </h2>

            <!-- Subheading -->
            <p class="text-[12px] md:text-[16px] lg:text-[20px]">
                Melayani Balita, Ibu Hamil, dan Lansia dengan cinta dan perhatian
            </p>
        </div>
    </div>
</div>
            
            <!-- Decorative Line -->
            <div class="mt-8 flex justify-center">
                <div class="w-24 h-1 bg-gradient-to-r from-transparent via-white to-transparent rounded-full"></div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="py-16 bg-white relative">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Balita Card -->
            <div class="group relative">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl blur opacity-25 group-hover:opacity-40 transition duration-500"></div>
                <div class="relative bg-white p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Balita Terdaftar</h3>
                    <p class="text-4xl font-bold text-blue-600 mb-2">{{ $jumlahBalita }}</p>
                    <p class="text-sm text-gray-500">Anak sehat, masa depan cerah</p>
                </div>
            </div>

            <!-- Ibu Hamil Card -->
            <div class="group relative">
                <div class="absolute inset-0 bg-gradient-to-r from-pink-500 to-rose-600 rounded-2xl blur opacity-25 group-hover:opacity-40 transition duration-500"></div>
                <div class="relative bg-white p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-rose-600 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Ibu Hamil</h3>
                    <p class="text-4xl font-bold text-pink-600 mb-2">{{ $jumlahIbuHamil }}</p>
                    <p class="text-sm text-gray-500">Ibu sehat, bayi sehat</p>
                </div>
            </div>

            <!-- Lansia Card -->
            <div class="group relative">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-2xl blur opacity-25 group-hover:opacity-40 transition duration-500"></div>
                <div class="relative bg-white p-8 rounded-2xl shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Lansia</h3>
                    <p class="text-4xl font-bold text-purple-600 mb-2">{{ $jumlahLansia }}</p>
                    <p class="text-sm text-gray-500">Menua dengan sehat</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Layanan Kesehatan Section -->
<div class="py-24 bg-green-600">
    <div class="container mx-auto px-4 max-w-7xl text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-16">Layanan Kesehatan</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Pemeriksaan Balita -->
            <div data-aos="fade-up" class="bg-white p-8 rounded-xl shadow-md hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
                <div class="text-5xl mb-4">👶</div>
                <h3 class="text-xl font-semibold text-green-700 mb-2">Pemeriksaan Balita</h3>
                <p class="text-sm text-green-600">Penimbangan, pengukuran tinggi badan, dan pemantauan tumbuh kembang balita</p>
            </div>

            <!-- Pemeriksaan Ibu Hamil -->
            <div data-aos="fade-up" data-aos-delay="100" class="bg-white p-8 rounded-xl shadow-md hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
                <div class="text-5xl mb-4">🤰</div>
                <h3 class="text-xl font-semibold text-green-700 mb-2">Pemeriksaan Ibu Hamil</h3>
                <p class="text-sm text-green-600">Kontrol kehamilan rutin dan edukasi kesehatan ibu</p>
            </div>

            <!-- Pemeriksaan Lansia -->
            <div data-aos="fade-up" data-aos-delay="200" class="bg-white p-8 rounded-xl shadow-md hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
                <div class="text-5xl mb-4">🧓</div>
                <h3 class="text-xl font-semibold text-green-700 mb-2">Pemeriksaan Lansia</h3>
                <p class="text-sm text-green-600">Pemeriksaan kesehatan rutin dan pemantauan kondisi kesehatan lansia</p>
            </div>

            <!-- Imunisasi -->
            <div data-aos="fade-up" data-aos-delay="300" class="bg-white p-8 rounded-xl shadow-md hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
                <div class="text-5xl mb-4">💉</div>
                <h3 class="text-xl font-semibold text-green-700 mb-2">Imunisasi</h3>
                <p class="text-sm text-green-600">Pemberian jadwal vaksin lengkap sesuai jadwal imunisasi</p>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-20 bg-gradient-to-r from-green-50 to-emerald-50 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23059669" fill-opacity="0.4"><circle cx="30" cy="30" r="2"/></g></svg>'); background-size: 60px 60px;"></div>
    </div>
    
    <div class="relative z-10 text-center max-w-4xl mx-auto px-4">
        <div class="mb-8">
            <h3 class="text-4xl md:text-4xl font-bold text-gray-800 mb-6">
                Layanan Kesehatan Gratis di
                <span class="text-green-600">Posyandu Kamboja</span>
            </h3>
            <p class="text-xl text-gray-600 max-w-xl mx-auto leading-relaxed">
                "Jangan tunggu sakit! Manfaatkan layanan Posyandu Kamboja untuk deteksi dini dan pencegahan masalah kesehatan. Cek kesehatan anak, imunisasi, dan dapatkan tips sehat setiap bulan!"
            </p>
        </div>
        
    </div>
</div>

<!-- Bottom Wave -->
<div class="relative">
    <svg class="w-full h-12 fill-green-600" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
    </svg>
</div>

@endsection