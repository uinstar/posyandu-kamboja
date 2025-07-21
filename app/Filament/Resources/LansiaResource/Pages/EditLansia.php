<?php

namespace App\Filament\Resources\LansiaResource\Pages;

use App\Filament\Resources\LansiaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Carbon\Carbon;

class EditLansia extends EditRecord
{
    protected static string $resource = LansiaResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (!empty($data['tanggal_lahir'])) {
            $data['usia'] = Carbon::parse($data['tanggal_lahir'])->age;
        }

        return $data;
    }
}
