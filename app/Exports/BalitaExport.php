<?php

namespace App\Exports;

use App\Models\Balita;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BalitaExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Balita::select([
            'nama',
            'umur',
            'berat_badan',
            'tinggi_badan',
            'created_at'
        ])->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Umur',
            'Berat Badan (kg)',
            'Tinggi Badan (cm)',
            'Tanggal Input',
        ];
    }

    public function map($balita): array
    {
        return [
            $balita->nama,
            $balita->umur,
            $balita->berat_badan,
            $balita->tinggi_badan,
            $balita->created_at->format('d/m/Y H:i:s'), // Format tanggal
        ];
    }
}