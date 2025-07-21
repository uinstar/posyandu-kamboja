<?php

namespace App\Filament\Pages;

use App\Models\PencatatanBalita;
use App\Models\PencatatanIbuHamil;
use App\Models\PencatatanLansia;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;

class Laporan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static string $view = 'filament.pages.laporan';

    public $tanggal;

    public function mount(): void
    {
        $this->form->fill();
    }

   public static function getNavigationGroup(): ?string
{
    return 'Reports';
}

public static function getNavigationSort(): ?int
{
    return 999; // Supaya tetap paling bawah di dalam grup
}

    protected function getFormSchema(): array
    {
        return [
            DatePicker::make('tanggal')
                ->label('Filter Bulan')
                ->displayFormat('F Y')
                ->native(false)
                ->required(),
        ];
    }

    public function submit()
    {
        // Pemicu submit form laporan
    }

    public function getData()
    {
        $date = Carbon::parse($this->tanggal);
        $start = $date->copy()->startOfMonth();
        $end = $date->copy()->endOfMonth();

        return [
            'balita' => PencatatanBalita::whereBetween('tanggal_posyandu', [$start, $end])->get(),
            'ibuhamil' => PencatatanIbuHamil::whereBetween('tanggal_posyandu', [$start, $end])->get(),
            'lansia' => PencatatanLansia::whereBetween('tanggal_posyandu', [$start, $end])->get(),
        ];
    }
}
