@extends('layouts.app')

@section('title', 'Formulir Pendaftaran')

@section('content')
<h2 class="text-2xl font-bold mb-6 text-green-700 text-center">Formulir Pendaftaran Peserta Posyandu</h2>

@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('form.submit') }}" class="grid grid-cols-1 gap-6 bg-white p-6 rounded shadow max-w-2xl mx-auto" id="pendaftaranForm">
    @csrf

    <div>
        <label class="block font-medium text-sm">Kategori <span class="text-red-500">*</span></label>
        <select name="kategori" id="kategori" class="w-full border rounded px-3 py-2" required>
            <option value="">-- Pilih Kategori --</option>
            <option value="balita" {{ old('kategori') == 'balita' ? 'selected' : '' }}>Balita</option>
            <option value="ibu_hamil" {{ old('kategori') == 'ibu_hamil' ? 'selected' : '' }}>Ibu Hamil</option>
            <option value="lansia" {{ old('kategori') == 'lansia' ? 'selected' : '' }}>Lansia</option>
        </select>
    </div>

    <!-- Input khusus Balita -->
    <div id="inputBalita" class="hidden space-y-4">
    <h3 class="text-lg font-semibold text-green-600 border-b pb-2">Data Balita</h3>

    <label class="block font-medium text-sm">Nama Bayi/Balita <span class="text-red-500">*</span></label>
        <input type="text" name="nama_balita" class="w-full border rounded px-3 py-2" value="{{ old('nama_balita') }}" required>

    <div>
        <label class="block font-medium text-sm">NIK Balita/Ibu <span class="text-red-500">*</span></label>
        <input type="text" name="nik" class="w-full border rounded px-3 py-2" maxlength="16" pattern="[0-9]{16}" value="{{ old('nik') }}" placeholder="16 digit angka" required>
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
        <label class="block font-medium text-sm">Berat Badan Lahir (kg) <span class="text-red-500">*</span></label>
        <input type="number" name="bb_lahir" step="0.1" class="w-full border rounded px-3 py-2" value="{{ old('bb_lahir') }}" required>
    </div>

    <div>
        <label class="block font-medium text-sm">Panjang Badan Lahir (cm) <span class="text-red-500">*</span></label>
        <input type="number" name="panjang_badan_lahir" step="0.1" class="w-full border rounded px-3 py-2" value="{{ old('panjang_badan_lahir') }}" required>
    </div>

    <div>
        <label class="block font-medium text-sm">Nama Ibu <span class="text-red-500">*</span></label>
        <input type="text" name="nama_ibu" class="w-full border rounded px-3 py-2" value="{{ old('nama_ibu') }}" required>
    </div>

    <div>
    <label class="block font-medium text-sm">Nomor HP <span class="text-red-500">*</span></label>
    <input type="text"
           name="no_hp"
           class="w-full border rounded px-3 py-2"
           value="{{ old('no_hp') }}"
           required
           pattern="[0-9]{10,15}"
           maxlength="15"
           inputmode="numeric"
           title="Nomor HP harus terdiri dari 10 hingga 15 digit angka">
    </div>

    <div>
        <label class="block font-medium text-sm">Alamat <span class="text-red-500">*</span></label>
        <textarea name="alamat" class="w-full border rounded px-3 py-2" rows="3" required>{{ old('alamat') }}</textarea>
    </div>
    </div>

    <!-- Input khusus Ibu Hamil -->
    <div id="inputIbuHamil" class="hidden space-y-4">
    <h3 class="text-lg font-semibold text-green-600 border-b pb-2">Data Ibu Hamil</h3>

    <div>
        <label class="block font-medium text-sm">Nama <span class="text-red-500">*</span></label>
        <input type="text" name="nama" class="w-full border rounded px-3 py-2" value="{{ old('nama') }}" required>
    </div>

    <div>
        <label class="block font-medium text-sm">NIK <span class="text-red-500">*</span></label>
        <input type="text" name="nik" class="w-full border rounded px-3 py-2" maxlength="16" pattern="[0-9]{16}" value="{{ old('nik') }}" placeholder="16 digit angka" required>
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
    <input type="text"
           name="no_hp"
           class="w-full border rounded px-3 py-2"
           value="{{ old('no_hp') }}"
           required
           pattern="[0-9]{10,15}"
           maxlength="15"
           inputmode="numeric"
           title="Nomor HP harus terdiri dari 10 hingga 15 digit angka">
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
    </div>


   <!-- Input khusus Lansia -->
    <div id="inputLansia" class="hidden space-y-4">
    <h3 class="text-lg font-semibold text-green-600 border-b pb-2">Data Lansia</h3>

    <div>
        <label class="block font-medium text-sm">Nama <span class="text-red-500">*</span></label>
        <input type="text" name="nama" class="w-full border rounded px-3 py-2" value="{{ old('nama') }}" required>
    </div>

    <div>
        <label class="block font-medium text-sm">NIK <span class="text-red-500">*</span></label>
        <input type="text" name="nik" class="w-full border rounded px-3 py-2" maxlength="16" pattern="[0-9]{16}" value="{{ old('nik') }}" placeholder="16 digit angka" required>
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
    <input type="text"
           name="no_hp"
           class="w-full border rounded px-3 py-2"
           value="{{ old('no_hp') }}"
           required
           pattern="[0-9]{10,15}"
           maxlength="15"
           inputmode="numeric"
           title="Nomor HP harus terdiri dari 10 hingga 15 digit angka">
    </div>
    </div>

    <div class="text-center mt-6">
    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition duration-200">
        Kirim Pendaftaran
    </button>
    </div>

<script>
    document.getElementById('kategori').addEventListener('change', function () {
        const balita = document.getElementById('inputBalita');
        const ibuHamil = document.getElementById('inputIbuHamil');
        const lansia = document.getElementById('inputLansia');
        
        // Hide all sections
        balita.classList.add('hidden');
        ibuHamil.classList.add('hidden');
        lansia.classList.add('hidden');

        // Remove required attributes from ALL sections
        removeAllRequiredAttributes();

        // Show relevant section and add required attributes
        if (this.value === 'balita') {
            balita.classList.remove('hidden');
            addRequiredAttributes('inputBalita');
        } else if (this.value === 'ibu_hamil') {
            ibuHamil.classList.remove('hidden');
            addRequiredAttributes('inputIbuHamil');
        } else if (this.value === 'lansia') {
            lansia.classList.remove('hidden');
            addRequiredAttributes('inputLansia');
        }
    });

   function removeAllRequiredAttributes() {
    const allSections = ['inputBalita', 'inputIbuHamil', 'inputLansia'];
    allSections.forEach(sectionId => {
        const section = document.getElementById(sectionId);
        const allInputs = section.querySelectorAll('input, select, textarea');
        allInputs.forEach(input => {
            input.removeAttribute('required');
            input.disabled = true; // <- tambahkan
        });
    });
}

function addRequiredAttributes(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        const inputs = section.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.setAttribute('required', 'required');
            input.disabled = false; // <- tambahkan
        });
    }
}


    // Initialize form state if there's an old value
    @if(old('kategori'))
        document.getElementById('kategori').dispatchEvent(new Event('change'));
    @endif
</script>
@endsection