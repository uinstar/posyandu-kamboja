@extends('layouts.app')

@section('title', 'Jadwal Posyandu')

@section('content')
<div class="bg-gradient-to-br from-green-50 to-emerald-50 min-h-screen pt-6 pb-2">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center p-3 bg-green-100 rounded-full mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h2 class="text-4xl font-bold text-green-800 mb-2">Jadwal Kegiatan Posyandu</h2>
            <p class="text-green-600 text-lg">Informasi lengkap jadwal kegiatan pelayanan kesehatan di Posyandu Kamboja</p>
        </div>

        <!-- Table Container -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-green-100">
            <!-- Table Header with Gradient -->
            <div class="bg-gradient-to-r from-green-600 via-green-700 to-emerald-600 px-6 py-4">
                <h3 class="text-xl font-semibold text-white flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Daftar Jadwal
                </h3>
            </div>

            <!-- Responsive Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-green-100">
                    <thead class="bg-gradient-to-r from-green-50 to-emerald-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-bold text-green-800 uppercase tracking-wider border-r border-green-100">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>Tanggal</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-green-800 uppercase tracking-wider border-r border-green-100">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"></path>
                                    </svg>
                                    <span>Hari</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-green-800 uppercase tracking-wider border-r border-green-100">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Waktu</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-green-800 uppercase tracking-wider border-r border-green-100">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span>Kegiatan</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-green-800 uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>Lokasi</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-green-50">
                        @foreach ($jadwal as $index => $item)
                        <tr class="hover:bg-green-25 transition-colors duration-200 {{ $index % 2 == 0 ? 'bg-white' : 'bg-green-25' }}">
                            <td class="px-6 py-4 whitespace-nowrap border-r border-green-50">
                                <div class="flex items-center">
                                    <div class="bg-green-100 rounded-lg p-2 mr-3">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="text-sm font-semibold text-gray-900">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border-r border-green-50">
                                <span class="inline-flex px-3 py-1 text-sm font-medium bg-blue-100 text-blue-800 rounded-full">
                                    {{ $item->hari }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border-r border-green-50">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-900">{{ $item->waktu }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 border-r border-green-50">
                                <div class="flex items-center">
                                    <div class="bg-emerald-100 rounded-lg p-2 mr-3">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900 leading-relaxed">{{ $item->jenis_kegiatan }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-900">{{ $item->lokasi }}</span>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Footer Info -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-t border-green-100">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div class="flex items-center text-sm text-green-600">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">Jadwal dapat berubah sewaktu-waktu</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <span>Terakhir diperbarui: {{ now()->format('d M Y, H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Info Penting -->
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 rounded-lg mt-4 mb-2 shadow-sm mx-6">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm font-medium">
            <strong>Informasi Penting:</strong> <br>
            Harap membawa <span class="font-semibold">Buku KIA</span> dan <span class="font-semibold">Kartu Identitas</span> saat menghadiri kegiatan Posyandu.
            </p>
            </div>
            </div>
@endsection