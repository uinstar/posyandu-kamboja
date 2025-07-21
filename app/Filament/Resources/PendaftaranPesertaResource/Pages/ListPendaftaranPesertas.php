<?php

namespace App\Filament\Resources\PendaftaranPesertaResource\Pages;

use App\Filament\Resources\PendaftaranPesertaResource;
use Filament\Resources\Pages\ListRecords;

class ListPendaftaranPesertas extends ListRecords
{
    protected static string $resource = PendaftaranPesertaResource::class;

    protected function canCreate(): bool
    {
        return false; // Ini akan menyembunyikan tombol "New pendaftaran peserta"
    }
}
