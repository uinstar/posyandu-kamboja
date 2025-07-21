<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class PencatatanLansia extends Model
{
    use HasFactory;

    protected $table = 'pencatatan_lansia';

    protected $fillable = [
        'lansia_id',
        'tanggal_posyandu',
        'berat_badan',
        'tinggi_badan',
        'lingkar_perut',
        'tekanan_darah',
        'gula_darah',
        'riwayat_penyakit',
        'merokok',
    ];

    protected $casts = [
        'riwayat_penyakit' => 'array',
    ];

    public function lansia()
    {
        return $this->belongsTo(Lansia::class);
    }
    public function pencatatans()
    {
    return $this->hasMany(PencatatanLansia::class);
    }

    public function getUsiaAttribute()
    {
        return Carbon::parse($this->lansia->tanggal_lahir)->age;
    }
}
