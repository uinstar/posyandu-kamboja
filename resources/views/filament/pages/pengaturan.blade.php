<x-filament::page>
    <h2 class="text-2xl font-bold mb-6 text-center">Pengaturan User</h2>

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Tambah User --}}
    <h3 class="text-lg font-semibold mb-4">Tambah User</h3>

    <form method="POST" action="{{ route('pengaturan.tambah-user') }}" class="space-y-4 max-w-xl mb-10">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="name" id="name" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm" />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm" />
        </div>

    <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm" />
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <select name="role" id="role" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                <option value="">Pilih Role</option>
                <option value="kader">Kader</option>
                <option value="bidan">Bidan</option>
            </select>
        </div>

        <div>
            <x-filament::button color="success" type="submit">
                Tambah
            </x-filament::button>
        </div>
    </form>

    {{-- Daftar User --}}
    <h3 class="text-lg font-semibold mb-4">Daftar User</h3>

    <table class="w-full text-sm table-auto border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Nama</th>
                <th class="p-2 border">Email</th>
                <th class="p-2 border">Role</th>
                <th class="p-2 border text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach (\App\Models\User::all() as $user)
                <tr class="hover:bg-gray-50">
                    <td class="p-2 border">{{ $user->name }}</td>
                    <td class="p-2 border">{{ $user->email }}</td>
                    <td class="p-2 border capitalize">{{ $user->role }}</td>
                    <td class="p-2 border text-center space-x-2">

                        {{-- Tombol hapus --}}
                        <form method="POST" action="{{ route('pengaturan.hapus-user', $user->id) }}"
                         class="inline-block"
                       onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                      @csrf
                  @method('DELETE')
                      <x-filament::button color="danger" size="sm" type="submit">
                        Hapus
                 </x-filament::button>
                </form>

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-filament::page>
