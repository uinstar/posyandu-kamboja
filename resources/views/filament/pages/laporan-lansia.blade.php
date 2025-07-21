<x-filament::page>
    <div style="background-color: #9b15c4ff; color: white;" class="rounded-xl p-6 mb-6 shadow-md">
    <h2 class="text-2xl font-bold mb-1 flex items-center gap-2">
        <x-heroicon-o-chart-bar class="w-6 h-6" />
        Laporan Data Lansia
    </h2>
    <p class="text-sm">Data dan Monitoring Kesehatan Lansia</p>
    </div>

    <div class="w-full max-w-[600px] mx-auto mt-6">
    @livewire(\App\Filament\Widgets\RiwayatPenyakitLansiaChart::class)
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

        <a href="{{ route('laporan.lansia.pdf', ['tanggal' => $this->tanggal]) }}" target="_blank">
           <x-filament::button color="info">
            Print
            </x-filament::button>
        </a>
    </div>
</form>

      @if ($this->tanggal)
        @php $data = $this->getData(); @endphp

        <div class="mt-6 space-y-6">
            <h2 class="text-lg font-bold">Laporan Lansia: {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('F Y') }}</h2>

             {{-- 🔹 LANSIA --}}
            @if (!empty($data['lansia']))
                <x-filament::section label="👵 Pencatatan Lansia" class="mt-6">
                    <table class="table-auto w-full text-sm border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-2 py-1 text-left">No</th>
                                <th class="border px-2 py-1 text-left">Nama</th>
                                <th class="border px-2 py-1 text-left whitespace-nowrap">Tanggal Lahir</th>
                                <th class="border px-2 py-1 text-left">Berat Badan</th>
                                <th class="border px-2 py-1 text-left">Tinggi Badan</th>
                                <th class="border px-2 py-1 text-left">Lingkar Perut</th>
                                <th class="border px-2 py-1 text-left">Tekanan Darah</th>
                                <th class="border px-2 py-1 text-left">Riwayat Penyakit</th>
                                <th class="border px-2 py-1 text-left">Merokok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['lansia'] as $item)
                                <tr>
                                    <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                                    <td class="border px-2 py-1">{{ $item->lansia->nama }}</td>
                                    <td class="border px-2 py-1">
                                    {{ optional($item->lansia)->tanggal_lahir ? \Carbon\Carbon::parse($item->lansia->tanggal_lahir)->format('d-m-Y') : '-' }}
                                    </td>
                                    <td class="border px-2 py-1">{{ $item->berat_badan }} kg</td>
                                    <td class="border px-2 py-1">{{ $item->tinggi_badan }} cm</td>
                                    <td class="border px-2 py-1">{{ $item->lingkar_perut }} cm</td>
                                    <td class="border px-2 py-1">{{ $item->tekanan_darah ?? '-' }}mmHg</td>
                                    <td class="border px-2 py-1">
                                        {{ is_array($item->riwayat_penyakit) ? implode(', ', $item->riwayat_penyakit) : $item->riwayat_penyakit }}
                                    </td>
                                    <td class="border px-2 py-1">{{ $item->merokok }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </x-filament::section>
            @endif
            
    @elseif($this->tanggal)
        {{-- Jika tanggal dipilih tapi data kosong --}}
        <div class="mt-6 text-sm text-gray-600 italic">
            Tidak ada data lansia untuk bulan {{ \Carbon\Carbon::parse($this->tanggal)->translatedFormat('F Y') }}.
        </div>
    @endif
</x-filament::page>
