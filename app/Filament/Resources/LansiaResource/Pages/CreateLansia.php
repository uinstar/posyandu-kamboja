<?php

namespace App\Filament\Resources\LansiaResource\Pages;

use App\Filament\Resources\LansiaResource;
use Filament\Resources\Pages\CreateRecord;
use Carbon\Carbon;

class CreateLansia extends CreateRecord
{
    protected static string $resource = LansiaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (!empty($data['tanggal_lahir'])) {
            $data['usia'] = Carbon::parse($data['tanggal_lahir'])->age;
        }

        return $data;
    }
}
