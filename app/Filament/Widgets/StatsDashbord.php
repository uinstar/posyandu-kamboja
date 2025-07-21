<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Balita;
use App\Models\IbuHamil;
use App\Models\Lansia;

class StatsDashbord extends BaseWidget
{

    protected static ?int $maxHeight = 300;
    
    protected function getStats(): array
    {
        return [
           Stat::make('Balita Terdaftar', Balita::count())
           ->description('Jumlah balita terdaftar')
           ->descriptionColor('info'),
            Stat::make('Ibu Hamil', IbuHamil::count())
            ->description('Jumlah ibu hamil terdaftar')
           ->descriptionColor('success'),
            Stat::make('Lansia', Lansia::count())
            ->description('Jumlah lansia terdaftar')
           ->descriptionColor('danger'),
        ];
    }
}
