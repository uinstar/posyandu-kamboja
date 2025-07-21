<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use App\Models\PencatatanLansia;

class RiwayatPenyakitLansiaChart extends BarChartWidget
{
    protected static ?string $heading = 'Distribusi Riwayat Penyakit Lansia';
    protected static ?int $sort = 1;

    protected function getData(): array
    {
        // Daftar penyakit dari sistem
        $penyakitList = [
            'Diabetes',
            'Hipertensi',
            'Jantung',
            'Stroke',
            'Asma',
            'Gangguan Penglihatan',
            'Gangguan Pendengaran',
            'Gangguan Mental',
            'Gangguan Emosional',
            'Lainnya',
            'Tidak Ada',
        ];

        // Siapkan array counter
        $counts = array_fill_keys($penyakitList, 0);

        // Ambil data pencatatan lansia
        $data = PencatatanLansia::orderByDesc('tanggal_posyandu')
        ->get()
        ->unique('lansia_id');


        foreach ($data as $item) {
            $riwayat = is_array($item->riwayat_penyakit)
                ? $item->riwayat_penyakit
                : json_decode($item->riwayat_penyakit, true);

            if (!is_array($riwayat)) continue;

            foreach ($riwayat as $penyakit) {
                if (isset($counts[$penyakit])) {
                    $counts[$penyakit]++;
                }
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Lansia',
                    'data' => array_values($counts),
                    'backgroundColor' => '#06b6d4',
                ],
            ],
            'labels' => array_keys($counts),
        ];
    }
}
