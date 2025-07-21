<?php

namespace App\Filament\Widgets;

use App\Models\PencatatanBalita;
use Filament\Widgets\ChartWidget;

class StatusGiziChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Status Gizi Balita';
    protected static ?int $sort = 1;

    protected function getData(): array
    {
        // Ambil pencatatan terakhir
        $latestData = PencatatanBalita::with('balita')
            ->get()
            ->sortByDesc('tanggal_posyandu')
            ->unique('balita_id');

        $grouped = $latestData->groupBy('status_gizi')->map->count();

        $warna = [
            'Normal' => '#4CAF50',
            'Gizi Kurang' => '#FFC107',
            'Gizi Buruk' => '#F44336',
            'Risiko Gizi Lebih' => '#2196F3',
        ];

        $labels = $grouped->keys()->toArray();
        $values = $grouped->values()->toArray();
        $backgroundColors = array_map(fn($label) => $warna[$label] ?? '#9E9E9E', $labels);

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Balita',
                    'data' => $values,
                    'backgroundColor' => $backgroundColors,
                ],
            ],
            'labels' => $labels,
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
                'x' => [
                    'display' => false,
                ],
                'y' => [
                    'display' => false,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
