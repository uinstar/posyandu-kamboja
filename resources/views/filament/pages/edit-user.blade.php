<x-filament::page>
    <h2 class="text-2xl font-bold mb-4">Edit User</h2>

    @if (session('success'))
        <div class="p-3 mb-4 text-green-800 bg-green-200 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('pengaturan.update-user', $user->id) }}" class="space-y-4 max-w-xl">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm" />
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <select name="role" id="role" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                <option value="kader" {{ $user->role === 'kader' ? 'selected' : '' }}>Kader</option>
                <option value="bidan" {{ $user->role === 'bidan' ? 'selected' : '' }}>Bidan</option>
            </select>
        </div>

        <div>
            <x-filament::button color="success">
                Simpan Perubahan
            </x-filament::button>
        </div>
    </form>

    <div class="mt-4">
        <a href="{{ route('filament.admin.pages.pengaturan') }}" class="text-blue-500 hover:underline">← Kembali ke Pengaturan</a>
    </div>
</x-filament::page>
