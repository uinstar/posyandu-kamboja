<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\PencatatanIbuHamil;

class RisikoKekChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Risiko KEK (Lingkar Lengan Ibu Hamil)';
    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $bulan = now()->format('m');
        $tahun = now()->format('Y');

        $data = PencatatanIbuHamil::whereMonth('tanggal_posyandu', $bulan)
            ->whereYear('tanggal_posyandu', $tahun)
            ->get()
            ->sortByDesc('tanggal_posyandu')
            ->unique('ibu_hamil_id');

        $kek = $data->where('lingkar_lengan', '<', 23.5)->count();
        $normal = $data->where('lingkar_lengan', '>=', 23.5)->count();

        return [
            'datasets' => [
                [
                    'label' => 'Distribusi KEK',
                    'data' => [$kek, $normal],
                    'backgroundColor' => ['#EF4444', '#10B981'],
                ],
            ],
            'labels' => ['Risiko KEK', 'Normal'],
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                ],
            ],
            'scales' => [
                'x' => ['display' => false],
                'y' => ['display' => false],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}

