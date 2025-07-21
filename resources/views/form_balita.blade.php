<form method="POST" action="{{ route('form.balita.submit') }}" class="grid grid-cols-1 gap-6 bg-white p-6 rounded shadow max-w-3xl mx-auto">
    @csrf

    <input type="hidden" name="kategori" value="balita">
    <div>
        <label class="block font-medium text-sm">Nama Balita <span class="text-red-500">*</span></label>
        <input type="text" name="nama" class="w-full border rounded px-3 py-2" value="{{ old('nama') }}" required>
    </div>

    <div>
        <label class="block font-medium text-sm">Nama Ibu <span class="text-red-500">*</span></label>
        <input type="text" name="nama_ibu" class="w-full border rounded px-3 py-2" value="{{ old('nama_ibu') }}" required>
    </div>

    <div>
        <label class="block font-medium text-sm">Nomor HP <span class="text-red-500">*</span></label>
        <input type="text" name="no_telepon" class="w-full border rounded px-3 py-2" value="{{ old('no_telepon') }}" required>
    </div>

    <div>
        <label class="block font-medium text-sm">Alamat <span class="text-red-500">*</span></label>
        <textarea name="alamat" class="w-full border rounded px-3 py-2" rows="3" required>{{ old('alamat') }}</textarea>
    </div>

    <div>
        <label class="block font-medium text-sm">NIK Balita/Ibu <span class="text-red-500">*</span></label>
        <input type="text" name="nik" class="w-full border rounded px-3 py-2" maxlength="16" pattern="[0-9]{16}" value="{{ old('nik') }}" placeholder="16 digit angka" required>
    </div>

    <div>
        <label class="block font-medium text-sm">Tanggal Lahir Balita <span class="text-red-500">*</span></label>
        <input type="date" name="tanggal_lahir" class="w-full border rounded px-3 py-2" value="{{ old('tanggal_lahir') }}" required>
    </div>

    <div>
        <label class="block font-medium text-sm">Berat Badan Lahir (kg) <span class="text-red-500">*</span></label>
        <input type="number" step="0.1" name="bb_lahir" class="w-full border rounded px-3 py-2" value="{{ old('bb_lahir') }}" required>
    </div>

    <div>
        <label class="block font-medium text-sm">Panjang Badan Lahir (cm) <span class="text-red-500">*</span></label>
        <input type="number" step="0.1" name="panjang_badan_lahir" class="w-full border rounded px-3 py-2" value="{{ old('panjang_badan_lahir') }}" required>
    </div>

    <div>
        <label class="block font-medium text-sm">Jenis Kelamin <span class="text-red-500">*</span></label>
        <select name="jenis_kelamin" class="w-full border rounded px-3 py-2" required>
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div> 
    
    <div class="text-center mt-6">
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition duration-200">
            Kirim Pendaftaran Balita
        </button>
    </div>
</form>
