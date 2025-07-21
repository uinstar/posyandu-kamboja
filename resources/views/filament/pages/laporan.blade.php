<x-filament::page>
    <form wire:submit.prevent="submit">
        <div class="flex items-end gap-4">
            {{-- Kolom Filter Bulan --}}
            <div class="w-1/4">
                {{ $this->form }}
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex items-center mt-6 gap-4">
    {{-- Tombol Tampilkan --}}
    <x-filament::button type="submit">
        Tampilkan Laporan
    </x-filament::button>

    {{-- Tombol Unduh PDF --}}
        <a href="{{ route('laporan.pdf', ['tanggal' => $this->tanggal]) }}" target="_blank">
            <x-filament::button color="info">
            Print
            </x-filament::button>
        </a>
</div>
</div>
    </form>

    @if ($this->tanggal)
        @php $data = $this->getData(); @endphp

        <div class="mt-6 space-y-6">
            <h2 class="text-lg font-bold">Laporan Bulan: {{ \Carbon\Carbon::parse($this->tanggal)->translatedFormat('F Y') }}</h2>

            {{-- 🔹 BALITA --}}
            @if (!empty($data['balita']))
                <x-filament::section label="🧒 Pencatatan Balita">
                    <table class="table-auto w-full mt-2 text-sm border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-2 py-1 text-left">No</th>
                                <th class="border px-2 py-1 text-left whitespace-nowrap">Nama</th>
                                <th class="border px-2 py-1 text-left whitespace-nowrap">Tanggal Lahir</th>
                                <th class="border px-2 py-1 text-left">Nama Ibu</th>
                                <th class="border px-2 py-1 text-left">Berat Badan</th>
                                <th class="border px-2 py-1 text-left">Tinggi Badan</th>
                                <th class="border px-2 py-1 text-left">Lingkar Kepala (LIKA)</th>
                                <th class="border px-2 py-1 text-left">Lingkar Lengan (LIKA)</th>
                                <th class="border px-2 py-1 text-left">Status Gizi</th>
                                <th class="border px-2 py-1 text-left">Usia</th>
                                <th class="border px-2 py-1 text-left">Imunisasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['balita'] as $item)
                                <tr>
                                    <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                                    <td class="border px-2 py-1 whitespace-nowrap">{{ $item->balita->nama }}</td>
                                    <td class="border px-2 py-1">
                                    {{ optional($item->balita)->tanggal_lahir ? \Carbon\Carbon::parse($item->balita->tanggal_lahir)->format('d-m-Y') : '-' }}
                                    </td>
                                    <td class="border px-2 py-1">{{ $item->balita->nama_ibu }}</td>
                                    <td class="border px-2 py-1">{{ $item->berat_badan }} kg</td>
                                    <td class="border px-2 py-1">{{ $item->tinggi_badan }} cm</td>
                                    <td class="border px-2 py-1">{{ $item->lingkar_kepala }} cm</td>
                                    <td class="border px-2 py-1">{{ $item->lingkar_lengan }} cm</td>
                                    <td class="border px-2 py-1 whitespace-nowrap">{{ $item->status_gizi }}</td>
                                    <td class="border px-2 py-1">{{ $item->usia_bulan }} bulan</td>
                                    <td class="border px-2 py-1">
                                        {{ is_array($item->jenis_imunisasi) ? implode(', ', $item->jenis_imunisasi) : $item->jenis_imunisasi }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </x-filament::section>
            @endif

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
                                    <td class="border px-2 py-1">{{ $item->tekanan_darah ?? '-' }}</td>
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

        </div>
    @endif
</x-filament::page>
