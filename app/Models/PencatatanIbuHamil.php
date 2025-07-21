<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PencatatanIbuHamil extends Model
{
    use HasFactory;

    protected $table = 'pencatatan_ibu_hamils'; 

    protected $fillable = [
        'ibu_hamil_id',
        'tanggal_posyandu',
        'usia_kehamilan',
        'berat_badan',
        'tinggi_badan',
        'lingkar_lengan',
        'tekanan_darah',
        'tablet_tambah_darah',
        'kelas_ibu_hamil',
        'gejala_sakit',
        'saran',
    ];

    // Relasi ke IbuHamil
    public function ibuHamil()
    {
        return $this->belongsTo(IbuHamil::class);
    }
}
