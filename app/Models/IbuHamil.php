<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IbuHamil extends Model
{
    protected $table = 'ibu_hamil';

    protected $fillable = [
        'nama',
        'nik',
        'tanggal_lahir',
        'nama_suami',
        'alamat',
        'no_hp',
        'hamil_ke',
        'berat_badan',
        'tinggi_badan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}
