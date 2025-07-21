<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Posyandu</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #000;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .header-text {
            flex: 1;
            text-align: center;
        }

        .header-text .title {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.4;
        }

        .header-text .subtitle {
            font-size: 14px;
            margin-top: 2px;
        }

        .header-text .period {
            font-size: 12px;
            font-style: italic;
            margin-top: 6px;
        }

        .section-title {
            margin-top: 30px;
            font-weight: bold;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #999;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        .ttd {
            margin-top: 40px;
            width: 100%;
            border: none;
            border-collapse: collapse;
        }

        .ttd td {
            border: none;
            text-align: center;
            padding-top: 10px;
        }

        .nama {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="header" style="display: table; width: 100%; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px;">
    <!-- Kolom Kiri: Logo -->
    <div style="display: table-cell; width: 20%; vertical-align: middle; text-align: center;">
        <img src="{{ public_path('bg/logo1.png') }}" alt="Logo Posyandu" width="100" height="100" style="border-radius: 50%;">
    </div>

    <!-- Kolom Tengah: Teks Judul -->
    <div style="display: table-cell; width: 60%; text-align: center; vertical-align: middle; font-family: sans-serif;">
        <div style="font-size: 20px; font-weight: bold; text-transform: uppercase;">Laporan Pemeriksaan Ibu Hamil Posyandu Kamboja</div>
        <div style="font-size: 16px; font-weight: normal;">Desa Panggungrejo Kecamatan Sukoharjo Kabupaten Pringsewu Provinsi Lampung</div>
        <div style="font-size: 14px; font-style: italic; margin-top: 5px;">Bulan: {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('F Y') }}</div>
    </div>

    <!-- Kolom Kanan: Kosong (penyeimbang) -->
    <div style="display: table-cell; width: 20%;"></div>
</div>

   {{-- IBU HAMIL --}}
    <div class="section-title" style="text-align: center;">Data Pemeriksaan Ibu Hamil </div>
    <table>
        <thead>
            <tr>
                <th>No</th><th>Nama</th><th>Tgl Lahir</th><th>Berat Badan</th><th>Tinggi Badan</th>
                <th>Lingkar Lengan</th><th>Tekanan Darah</th><th>Usia Kehamilan</th><th>Keluhan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ibuhamil as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->ibuHamil->nama }}</td>
                     <td>
                        {{ optional($item->ibuHamil)->tanggal_lahir ? \Carbon\Carbon::parse($item->ibuHamil->tanggal_lahir)->format('d-m-Y') : '-' }}
                    </td>
                    <td>{{ $item->berat_badan }} kg</td>
                    <td>{{ $item->tinggi_badan }} cm</td>
                    <td>{{ $item->lingkar_lengan }} cm</td>
                    <td>{{ $item->tekanan_darah }} mmHg</td>
                    <td>{{ $item->usia_kehamilan }} minggu</td>
                    <td>{{ $item->gejala_sakit ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- TANDA TANGAN --}}
    <table class="ttd">
    <tr>
        <td style="text-align: right; padding-right: 80px;">
            <div style="display: inline-block; text-align: center;">
                Ketua Posyandu Kamboja,<br><br><br>
                @if ($qrBase64)
                    <img src="{{ $qrBase64 }}" alt="QR Code" width="100"><br><br>
                @endif
                <span class="nama">Primayanti</span>
            </div>
        </td>
    </tr>
</table>

</body>
</html>
