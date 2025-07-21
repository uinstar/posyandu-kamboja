<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use App\Helpers\GiziHelper;

class PencatatanBalita extends Model
{
    use HasFactory;

    protected $table = 'pencatatan_balitas';

    protected $fillable = [
        'balita_id',
        'tanggal_posyandu',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
        'lingkar_lengan',
        'status_gizi',
        'usia_bulan',
        'jenis_imunisasi',
        'gejala_sakit',
        'saran',
    ];

    public function balita()
    {
        return $this->belongsTo(Balita::class);
    }

    protected static function booted()
    {
        // Saat membuat baru
        static::creating(function ($record) {
            static::hitungStatus($record);
        });

        // Saat update
        static::updating(function ($record) {
            static::hitungStatus($record);
        });
    }

    /**
     * Fungsi untuk menghitung usia dan status gizi
     */
    protected static function hitungStatus(self $record): void
{
    $balita = $record->balita;

    if ($balita && $record->tanggal_posyandu) {
        $record->usia_bulan = Carbon::parse($balita->tanggal_lahir)->diffInMonths($record->tanggal_posyandu);
    }

    if ($record->tinggi_badan && $record->berat_badan) {
        $record->status_gizi = GiziHelper::getZScoreStatus(
            $record->berat_badan,
            $record->tinggi_badan,
            $balita->jenis_kelamin ?? 'laki-laki' // default jika null
        );
    }
}
}
