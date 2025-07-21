<x-filament::page>
    <div style="background-color: #1049c4ff; color: white;" class="rounded-xl p-6 mb-6 shadow-md">
    <h2 class="text-2xl font-bold mb-1 flex items-center gap-2">
        <x-heroicon-o-chart-bar class="w-6 h-6" />
        Laporan Data Balita
    </h2>
    <p class="text-sm">Data pertumbuhan dan perkembangan balita</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    {{-- Grafik Status Gizi Balita--}}
    <div class="bg-white p-6 rounded-lg shadow w-full flex flex-col items-center">
        <div class="w-full max-w-[400px] h-64">
            <livewire:status-gizi-chart />
        </div>
    </div>

    {{-- Grafik Distribusi Umur Balita--}}
    <div class="bg-white p-6 rounded-lg shadow w-full flex flex-col items-center">
        <div class="w-full max-w-[400px] h-64">
            <livewire:distribusi-umur-balita-chart />
        </div>
    </div>
</div>

    <form wire:submit.prevent="submit" class="flex flex-wrap justify-between items-end gap-4 mb-6">
    {{-- Kolom Filter Bulan --}}
    <div class="flex-1 min-w-[250px]">
    {{ $this->form }}
    </div>

    {{-- Tombol Aksi --}}
    <div class="flex gap-3">
        <x-filament::button type="submit" color="success">
            Tampilkan Laporan
        </x-filament::button>

        <a href="{{ route('laporan.balita.pdf', ['tanggal' => $this->tanggal]) }}" target="_blank">
            <x-filament::button color="info">
             Print
            </x-filament::button>
        </a>
    </div>
</form>

      @if ($this->tanggal)
        @php $data = $this->getData(); @endphp

        <div class="mt-6 space-y-6">
            <h2 class="text-lg font-bold">Laporan Balita: {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('F Y') }}</h2>

            {{-- Section BALITA --}}
            <x-filament::section label="Pencatatan Balita">
                <table class="table-auto w-full mt-4 text-sm border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-2 py-1 text-left">No</th>
                            <th class="border px-2 py-1 text-left">Nama</th>
                            <th class="border px-2 py-1 text-left">Tanggal Lahir</th>
                            <th class="border px-2 py-1 text-left">Nama Ibu</th>
                            <th class="border px-2 py-1 text-left">Berat Badan</th>
                            <th class="border px-2 py-1 text-left">Tinggi Badan</th>
                            <th class="border px-2 py-1 text-left">Lingkar Kepala</th>
                            <th class="border px-2 py-1 text-left">Lingkar Lengan</th>
                            <th class="border px-2 py-1 text-left">Status Gizi</th>
                            <th class="border px-2 py-1 text-left">Usia</th>
                            <th class="border px-2 py-1 text-left">Imunisasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['balita'] as $item)
                            <tr>
                                <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                                <td class="border px-2 py-1">{{ $item->balita->nama }}</td>
                                <td class="border px-2 py-1">
                                {{ optional($item->balita)->tanggal_lahir ? \Carbon\Carbon::parse($item->balita->tanggal_lahir)->format('d-m-Y') : '-' }}
                                </td>
                                <td class="border px-2 py-1">{{ $item->balita->nama_ibu }}</td>
                                <td class="border px-2 py-1">{{ $item->berat_badan }} kg</td>
                                <td class="border px-2 py-1">{{ $item->tinggi_badan }} cm</td>
                                <td class="border px-2 py-1">{{ $item->lingkar_kepala }} cm</td>
                                <td class="border px-2 py-1">{{ $item->lingkar_lengan }} cm</td>
                                <td class="border px-2 py-1">{{ $item->status_gizi }}</td>
                                <td class="border px-2 py-1">{{ $item->usia_bulan }} bln</td>
                                <td class="border px-2 py-1">
                                    {{ is_array($item->jenis_imunisasi) ? implode(', ', $item->jenis_imunisasi) : $item->jenis_imunisasi }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-filament::section>
        </div>
    @elseif($this->tanggal)
        {{-- Jika tanggal dipilih tapi data kosong --}}
        <div class="mt-6 text-sm text-gray-600 italic">
            Tidak ada data balita untuk bulan {{ \Carbon\Carbon::parse($this->tanggal)->translatedFormat('F Y') }}.
        </div>
    @endif
</x-filament::page>
