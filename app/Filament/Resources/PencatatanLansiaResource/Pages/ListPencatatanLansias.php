<?php

namespace App\Filament\Resources\PencatatanLansiaResource\Pages;

use App\Filament\Resources\PencatatanLansiaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPencatatanLansias extends ListRecords
{
    protected static string $resource = PencatatanLansiaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
