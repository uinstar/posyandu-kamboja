<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balita extends Model
{
    protected $table = 'balita';

    protected $fillable = [
    'nama',
    'nik',
    'tanggal_lahir',
    'jenis_kelamin',
    'bb_lahir',
    'panjang_badan_lahir',
    'nama_ibu',
    'no_hp',
    'alamat',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}
