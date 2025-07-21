<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPosyandu extends Model
{
    protected $table = 'jadwal_posyandu';

    protected $fillable = [
        'tanggal',
        'hari',
        'waktu',
        'lokasi',
        'jenis_kegiatan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu' => 'datetime:H:i',
    ];
}
