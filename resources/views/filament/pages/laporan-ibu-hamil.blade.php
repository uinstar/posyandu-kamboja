<x-filament::page>
    <div style="background-color: #ff03b3ff; color: white;" class="rounded-xl p-6 mb-6 shadow-md">
    <h2 class="text-2xl font-bold mb-1 flex items-center gap-2">
        <x-heroicon-o-chart-bar class="w-6 h-6" />
        Laporan Data Lansia
    </h2>
    <p class="text-sm">Data dan Monitoring Kesehatan Ibu Hamil</p>
    </div>

 {{-- 🔸 Grafik Risiko KEK --}}
    <div class="mt-6 flex justify-left">
    <div class="w-[300px]">
        @livewire(\App\Filament\Widgets\RisikoKekChart::class)
    </div>
</div>

    {{-- Form Filter --}}
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

        <a href="{{ route('laporan.ibu_hamil.pdf', ['tanggal' => $this->tanggal]) }}" target="_blank">
            <x-filament::button color="info">
            Print
            </x-filament::button>
        </a>
    </div>
</form>

      @if ($this->tanggal)
        @php $data = $this->getData(); @endphp

        <div class="mt-6 space-y-6">
            <h2 class="text-lg font-bold">Laporan Ibu Hamil: {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('F Y') }}</h2>

            {{-- 🔹 IBU HAMIL --}}
            @if (!empty($data['ibuhamil']))
                <x-filament::section label="🤰 Pencatatan Ibu Hamil" class="mt-6">
                    <table class="table-auto w-full text-sm border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-2 py-1 text-left">No</th>
                                <th class="border px-2 py-1 text-left">Nama</th>
                                <th class="border px-2 py-1 text-left whitespace-nowrap">Tanggal Lahir</th>
                                <th class="border px-2 py-1 text-left">Berat Badan</th>
                                <th class="border px-2 py-1 text-left">Tinggi Badan</th>
                                <th class="border px-2 py-1 text-left">Lingkar Lengan</th>
                                <th class="border px-2 py-1 text-left">Tekanan Darah</th>
                                <th class="border px-2 py-1 text-left">Usia Kehamilan</th>
                                <th class="border px-2 py-1 text-left">Keluhan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['ibuhamil'] as $item)
                                <tr>
                                    <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                                    <td class="border px-2 py-1">{{ $item->ibuHamil->nama }}</td>
                                    <td class="border px-2 py-1">
                                    {{ optional($item->ibuHamil)->tanggal_lahir ? \Carbon\Carbon::parse($item->ibuHamil->tanggal_lahir)->format('d-m-Y') : '-' }}
                                    </td>
                                    <td class="border px-2 py-1">{{ $item->berat_badan }} kg</td>
                                    <td class="border px-2 py-1">{{ $item->tinggi_badan }} cm</td>
                                    <td class="border px-2 py-1">{{ $item->lingkar_lengan }} cm</td>
                                    <td class="border px-2 py-1">{{ $item->tekanan_darah ?? '-' }} mmHg</td>
                                    <td class="border px-2 py-1">{{ $item->usia_kehamilan }} minggu</td>
                                    <td class="border px-2 py-1">{{ $item->gejala_sakit ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </x-filament::section>
            @endif
            
    @elseif($this->tanggal)
        {{-- Jika tanggal dipilih tapi data kosong --}}
        <div class="mt-6 text-sm text-gray-600 italic">
            Tidak ada data ibu hamil untuk bulan {{ \Carbon\Carbon::parse($this->tanggal)->translatedFormat('F Y') }}.
        </div>
    @endif
</x-filament::page>
