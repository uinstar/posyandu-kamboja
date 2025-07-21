<?php

namespace App\Filament\Resources\PencatatanBalitaResource\Pages;

use App\Filament\Resources\PencatatanBalitaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPencatatanBalitas extends ListRecords
{
    protected static string $resource = PencatatanBalitaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
