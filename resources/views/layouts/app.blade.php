<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Posyandu Kamboja')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-[58px] h-[58px] rounded-lg overflow-hidden">
                        <img src="/bg/logo1.png" alt="Logo Posyandu" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-green-700">Posyandu Kamboja</h1>
                        <p class="text-xs text-gray-500 leading-none">Melayani Dengan Cinta</p>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <ul class="hidden md:flex items-center space-x-8">
                    <li>
                        <a href="{{ route('home') }}" class="flex items-center space-x-1 px-3 py-2 text-gray-700 hover:text-green-600 transition-colors {{ request()->routeIs('home') ? 'text-green-600 font-semibold' : '' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profil') }}" class="flex items-center space-x-1 px-3 py-2 text-gray-700 hover:text-green-600 transition-colors {{ request()->routeIs('profil') ? 'text-green-600 font-semibold' : '' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Profil</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('jadwal') }}" class="flex items-center space-x-1 px-3 py-2 text-gray-700 hover:text-green-600 transition-colors {{ request()->routeIs('jadwal') ? 'text-green-600 font-semibold' : '' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Jadwal</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('form') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors font-medium {{ request()->routeIs('form') ? 'bg-green-700' : '' }}">
                            Pendaftaran
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/login') }}" class="flex items-center space-x-1 px-3 py-2 text-gray-700 hover:text-green-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Login</span>
                        </a>
                    </li>
                </ul>

                <!-- Mobile Menu Toggle -->
                <div class="md:hidden">
                    <button id="mobileMenuButton" class="p-2 text-gray-700 hover:text-green-600 focus:outline-none" onclick="toggleMobileMenu()">
                        <svg class="w-6 h-6" id="menuIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg class="w-6 h-6 hidden" id="closeIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div class="md:hidden hidden bg-white border-t" id="mobileMenu">
                <div class="px-4 py-4 space-y-2">
                    <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg hover:bg-green-50 transition {{ request()->routeIs('home') ? 'text-green-600 bg-green-50 font-semibold' : 'text-gray-700' }}">Beranda</a>
                    <a href="{{ route('profil') }}" class="block px-3 py-2 rounded-lg hover:bg-green-50 transition {{ request()->routeIs('profil') ? 'text-green-600 bg-green-50 font-semibold' : 'text-gray-700' }}">Profil</a>
                    <a href="{{ route('jadwal') }}" class="block px-3 py-2 rounded-lg hover:bg-green-50 transition {{ request()->routeIs('jadwal') ? 'text-green-600 bg-green-50 font-semibold' : 'text-gray-700' }}">Jadwal</a>
                    <a href="{{ route('form') }}" class="block px-3 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 transition {{ request()->routeIs('form') ? 'bg-green-700' : '' }}">Pendaftaran</a>
                    <a href="{{ url('/admin/login') }}" class="block px-3 py-2 rounded-lg hover:bg-green-50 transition text-gray-700">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-10">
        @yield('content')
    </main>

    <!-- Mobile Menu Script -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            const menuIcon = document.getElementById('menuIcon');
            const closeIcon = document.getElementById('closeIcon');

            menu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        }

        // Close mobile menu when clicking link
        document.querySelectorAll('#mobileMenu a').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('mobileMenu').classList.add('hidden');
                document.getElementById('menuIcon').classList.remove('hidden');
                document.getElementById('closeIcon').classList.add('hidden');
            });
        });
    </script>

</body>

<!-- Footer -->
<footer class="bg-green-600 text-white py-10">
    <div class="container mx-auto px-6 md:px-12 lg:px-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 text-sm text-left">
            <div>
                <h3 class="text-lg font-bold mb-3">Posyandu Kamboja</h3>
                <p>Melayani balita, ibu hamil, dan lansia dengan cinta dan perhatian untuk kesehatan masyarakat.</p>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-3">Navigasi</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="hover:underline">Beranda</a></li>
                    <li><a href="{{ route('profil') }}" class="hover:underline">Profil</a></li>
                    <li><a href="{{ route('jadwal') }}" class="hover:underline">Jadwal</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-3">Alamat</h3>
                <p>Jalan Kapten CPM Suratno No. 225</p>
                <p>Desa Panggungrejo</p>
                <p>Kecamatan Sukoharjo, Kabupaten Pringsewu</p>
                <p>Lampung</p>
            </div>
            <div>
                <h3 class="text-lg font-bold mb-3">Kontak</h3>
                <p>📞 0819-5845-1835</p>
                <p>✉️ posyandukamboja@.com</p>
                <p>📱 IG: @posyandukamboja</p>
            </div>
        </div>
        <div class="border-t border-white mt-10 pt-6 text-xs text-white/70 text-center">
            &copy; {{ date('Y') }} Posyandu Kamboja. Semua hak dilindungi.
        </div>
    </div>
</footer>
</html>
