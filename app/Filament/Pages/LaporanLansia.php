<?php

namespace App\Filament\Pages;

use App\Models\PencatatanLansia;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Page;
use Filament\Forms;
use Illuminate\Support\Carbon;

class LaporanLansia extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Laporan Lansia';
    protected static ?string $navigationGroup = 'Reports';

    protected static string $view = 'filament.pages.laporan-Lansia';

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
    return 998; // Supaya tetap paling bawah di dalam grup
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
           'lansia' => PencatatanLansia::whereBetween('tanggal_posyandu', [$start, $end])->get(),
        ];
    }
}
