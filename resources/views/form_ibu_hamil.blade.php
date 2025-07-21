@extends('layouts.app')

@section('title', 'Formulir Pendaftaran Ibu Hamil')

@section('content')
<h2 class="text-2xl font-bold mb-6 text-green-700">Formulir Pendaftaran Ibu Hamil</h2>

<form method="POST" action="{{ route('form.ibu_hamil.submit') }}" class="grid grid-cols-1 gap-6 bg-white p-6 rounded shadow max-w-3xl mx-auto">
    @csrf

    <div>
        <label class="block font-medium text-sm">Nama <span class="text-red-500">*</span></label>
        <input type="text" name="nama" class="w-full border rounded px-3 py-2" value="{{ old('nama') }}" required>
    </div>

    <div>
        <label class="block font-medium text-sm">NIK <span class="text-red-500">*</span></label>
        <input type="text" name="nik" class="w-full border rounded px-3 py-2" maxlength="16" pattern="[0-9]{16}" placeholder="16 digit angka" value="{{ old('nik') }}" required>
    </div>

    <div>
        <label class="block font-medium text-sm">Tanggal Lahir <span class="text-red-500">*</span></label>
        <input type="date" name="tanggal_lahir" class="w-full border rounded px-3 py-2" value="{{ old('tanggal_lahir') }}" required>
    </div>

    <div>
        <label class="block font-medium text-sm">Nama Suami <span class="text-red-500">*</span></label>
        <input type="text" name="nama_suami" class="w-full border rounded px-3 py-2" value="{{ old('nama_suami') }}" required>
    </div>

    <div>
        <label class="block font-medium text-sm">Alamat <span class="text-red-500">*</span></label>
        <textarea name="alamat" class="w-full border rounded px-3 py-2" rows="3" required>{{ old('alamat') }}</textarea>
    </div>

    <div>
        <label class="block font-medium text-sm">Nomor HP <span class="text-red-500">*</span></label>
        <input type="text" name="no_hp" class="w-full border rounded px-3 py-2" value="{{ old('no_hp') }}" required>
    </div>

    <div>
        <label class="block font-medium text-sm">Hamil Anak ke- <span class="text-red-500">*</span></label>
        <input type="number" name="hamil_ke" min="1" class="w-full border rounded px-3 py-2" value="{{ old('hamil_ke') }}" required>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block font-medium text-sm">Berat Badan (kg) <span class="text-red-500">*</span></label>
            <input type="number" step="0.1" name="berat_badan" class="w-full border rounded px-3 py-2" value="{{ old('berat_badan') }}" required>
        </div>
        <div>
            <label class="block font-medium text-sm">Tinggi Badan (cm) <span class="text-red-500">*</span></label>
            <input type="number" step="0.1" name="tinggi_badan" class="w-full border rounded px-3 py-2" value="{{ old('tinggi_badan') }}" required>
        </div>
    </div>

    <div class="text-center mt-6">
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition duration-200">
            Kirim Pendaftaran Ibu Hamil
        </button>
    </div>
</form>
@endsection
