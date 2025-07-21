<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lansia extends Model
{
    protected $table = 'lansia';

    protected $fillable = [
        'nama',
        'nik',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'alamat',
        'no_hp',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    
}
