@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil')

@section('content')
<div class="max-w-lg mx-auto p-6 bg-green-100 rounded text-center">
    <h1 class="text-3xl font-bold mb-4">Terima Kasih!</h1>
    <p class="mb-4">Pendaftaran Anda berhasil dikirim. Kami akan memproses data Anda segera.</p>
    <a href="{{ url('/') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kembali ke Beranda</a>
</div>
@endsection
