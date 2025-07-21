<?php

namespace App\Filament\Widgets;

use App\Models\Balita;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class DistribusiUmurBalitaChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Usia Balita';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $now = Carbon::now();

        // Ambil data balita unik berdasarkan NIK
        $balitaUnik = Balita::all()->unique('nik');

        // Inisialisasi kategori usia baru
        $kategori = [
            '0–6 Bulan'    => 0,
            '6–12 Bulan'   => 0,
            '1–3 Tahun'    => 0,
            '3–5 Tahun'    => 0,
        ];

        // Klasifikasikan berdasarkan umur dalam bulan
        foreach ($balitaUnik as $balita) {
            $umur = Carbon::parse($balita->tanggal_lahir)->diffInMonths($now);

            if ($umur <= 6) {
                $kategori['0–6 Bulan']++;
            } elseif ($umur <= 12) {
                $kategori['6–12 Bulan']++;
            } elseif ($umur <= 36) {
                $kategori['1–3 Tahun']++;
            } elseif ($umur <= 60) {
                $kategori['3–5 Tahun']++;
            }

            // Di atas 5 tahun diabaikan
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Balita',
                    'data' => array_values($kategori),
                    'backgroundColor' => '#36A2EB',
                ],
            ],
            'labels' => array_keys($kategori),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    public static function isLazy(): bool
    {
        return false;
    }

    public static function canView(): bool
    {
        return true;
    }
}
