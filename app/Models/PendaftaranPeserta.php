<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendaftaranPeserta extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_peserta';

    protected $fillable = [
        'kategori',
        'data_tambahan',
        'status',
    ];

    protected $casts = [
        'data_tambahan' => 'array',
    ];

    protected static function booted()
    {
        static::updated(function ($peserta) {
            $kategori = strtolower(str_replace(' ', '_', $peserta->kategori));
            $dataTambahan = $peserta->data_tambahan ?? [];

            if (!empty($dataTambahan['no_hp']) && !preg_match('/^\d{10,15}$/', $dataTambahan['no_hp'])) {
              throw new \Exception("No HP harus terdiri dari 10 hingga 15 digit angka.");
                }
                
            if (
                $peserta->status === 'disetujui' &&
                $peserta->wasChanged('status')
            ) {
                // Handle Balita
                if ($kategori === 'balita' && isset($dataTambahan['nama_balita'])) {

                  $nik = $dataTambahan['nik'] ?? '';

                 // ✅ Validasi manual: harus 16 digit angka
                     if (!preg_match('/^\d{16}$/', $nik)) {
                    throw new \Exception("NIK Balita harus terdiri dari 16 angka.");
                       }

                        if (!\App\Models\Balita::where('nama', $dataTambahan['nama_balita'])->exists()) {
                        \App\Models\Balita::create([
                         'nama' => $dataTambahan['nama_balita'],
                         'nik' => $nik,
                         'tanggal_lahir' => $dataTambahan['tanggal_lahir'] ?? now()->subYears(2),
                         'jenis_kelamin' => $dataTambahan['jenis_kelamin'] ?? 'Laki-laki',
                         'bb_lahir' => $dataTambahan['bb_lahir'] ?? 0,
                         'panjang_badan_lahir' => $dataTambahan['panjang_badan_lahir'] ?? 0,
                          'nama_ibu' => $dataTambahan['nama_ibu'] ?? '',
                          'alamat' => $dataTambahan['alamat'] ?? '',
                          'no_hp' => $dataTambahan['no_hp'] ?? '',
                          ]);
                           }
                            }
                // Handle Ibu Hamil
                if ($kategori === 'ibu_hamil' && isset($dataTambahan['nama']) &&
                    !\App\Models\IbuHamil::where('nama', $dataTambahan['nama'])->exists()) {

                    \App\Models\IbuHamil::create([
                        'nama' => $dataTambahan['nama'],
                        'nik' => $dataTambahan['nik'] ?? '',
                        'tanggal_lahir' => $dataTambahan['tanggal_lahir'] ?? now()->subYears(25),
                        'nama_suami' => $dataTambahan['nama_suami'] ?? '',
                        'alamat' => $dataTambahan['alamat'] ?? '',
                        'no_hp' => $dataTambahan['no_hp'] ?? '',
                        'hamil_ke' => $dataTambahan['hamil_ke'] ?? 1,
                        'berat_badan' => $dataTambahan['berat_badan'] ?? 0,
                        'tinggi_badan' => $dataTambahan['tinggi_badan'] ?? 0,
                    ]);
                }

                // Handle Lansia
                if ($kategori === 'lansia' && isset($dataTambahan['nama']) &&
                    !\App\Models\Lansia::where('nama', $dataTambahan['nama'])->exists()) {

                    \App\Models\Lansia::create([
                        'nama' => $dataTambahan['nama'],
                        'nik' => $dataTambahan['nik'] ?? '',
                        'tanggal_lahir' => $dataTambahan['tanggal_lahir'] ?? now()->subYears(60),
                        'jenis_kelamin' => $dataTambahan['jenis_kelamin'] ?? 'Laki-laki',
                        'pekerjaan' => $dataTambahan['pekerjaan'] ?? '',
                        'alamat' => $dataTambahan['alamat'] ?? '',
                        'no_hp' => $dataTambahan['no_hp'] ?? '',
                    ]);
                }
            }
        });
    }

    public function getDataTambahanFormatted()
    {
        if (empty($this->data_tambahan)) {
            return 'Tidak ada data tambahan';
        }

        $data = $this->data_tambahan;
        $formatted = [];

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $formatted[] = ucwords(str_replace('_', ' ', $key)) . ': ' . implode(', ', $value);
            } else {
                $formatted[] = ucwords(str_replace('_', ' ', $key)) . ': ' . $value;
            }
        }

        return implode('<br>', $formatted);
    }

    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'pending' => 'warning',
            'disetujui' => 'success',
            'ditolak' => 'danger',
            default => 'secondary',
        };
    }

    public function getKategoriColorAttribute()
    {
        return match ($this->kategori) {
            'Balita' => 'success',
            'Ibu Hamil' => 'warning',
            'Lansia' => 'info',
            default => 'secondary',
        };
    }
}
