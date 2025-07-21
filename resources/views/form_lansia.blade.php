@extends('layouts.app')

@section('title', 'Formulir Pendaftaran Lansia')

@section('content')
<h2 class="text-2xl font-bold mb-6 text-green-700">Formulir Pendaftaran Lansia</h2>

<form method="POST" action="{{ route('form.lansia.submit') }}" class="grid grid-cols-1 gap-6 bg-white p-6 rounded shadow max-w-3xl mx-auto">
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
        <label class="block font-medium text-sm">Jenis Kelamin <span class="text-red-500">*</span></label>
        <select name="jenis_kelamin" class="w-full border rounded px-3 py-2" required>
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>

    <div>
        <label class="block font-medium text-sm">Pekerjaan <span class="text-red-500">*</span></label>
        <input type="text" name="pekerjaan" class="w-full border rounded px-3 py-2" value="{{ old('pekerjaan') }}" required>
    </div>

    <div>
        <label class="block font-medium text-sm">Alamat <span class="text-red-500">*</span></label>
        <textarea name="alamat" class="w-full border rounded px-3 py-2" rows="3" required>{{ old('alamat') }}</textarea>
    </div>

    <div>
        <label class="block font-medium text-sm">Nomor HP <span class="text-red-500">*</span></label>
        <input type="text" name="no_hp" class="w-full border rounded px-3 py-2" value="{{ old('no_hp') }}" required>
    </div>

    <div class="text-center mt-6">
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition duration-200">
            Kirim Pendaftaran Lansia
        </button>
    </div>
</form>
@endsection
