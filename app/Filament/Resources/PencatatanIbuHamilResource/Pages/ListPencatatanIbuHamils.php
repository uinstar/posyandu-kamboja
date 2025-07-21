<?php

namespace App\Filament\Resources\PencatatanIbuHamilResource\Pages;

use App\Filament\Resources\PencatatanIbuHamilResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPencatatanIbuHamils extends ListRecords
{
    protected static string $resource = PencatatanIbuHamilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
