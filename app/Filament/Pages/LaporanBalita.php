<?php

namespace App\Filament\Pages;

use App\Models\PencatatanBalita;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Page;
use Filament\Forms;
use Illuminate\Support\Carbon;
use App\Filament\Widgets\StatusGiziChart;

class LaporanBalita extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Laporan Balita';
    protected static ?string $navigationGroup = 'Reports';

    protected static string $view = 'filament.pages.laporan-balita';

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
    return 996; // Supaya tetap paling bawah di dalam grup
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
            'balita' => PencatatanBalita::with('balita')->whereBetween('tanggal_posyandu', [$start, $end])->get(),
        ];
    }
    public static function getWidgets(): array
{
    return [
        Widgets\StatusGiziChart::class,
        Widgets\DistribusiUmurBalitaChart::class,
    ];
}
}
