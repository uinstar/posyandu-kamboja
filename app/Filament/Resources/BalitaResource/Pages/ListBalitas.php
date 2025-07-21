<?php

namespace App\Filament\Resources\BalitaResource\Pages;

use App\Filament\Resources\BalitaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Facades\Filament;

class ListBalitas extends ListRecords
{
    protected static string $resource = BalitaResource::class;

    protected function getHeaderActions(): array
    {
        $actions = [];

        $user = Filament::auth()?->user();

        // Hanya tampilkan tombol "Tambah" jika user adalah kader
        if ($user && $user->role === 'kader') {
            $actions[] = Actions\CreateAction::make();
        }

        return $actions;
    }
}
