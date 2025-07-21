<?php

namespace App\Helpers;

class GiziHelper
{
    public static function getZScoreStatus(float $bb, float $tb, string $jenisKelamin): string
    {
        $tb = round($tb); // Bulatkan tinggi ke cm

        // 🔧 Ubah path ke direktori app/data
        $file = base_path('app/data/' . ($jenisKelamin === 'perempuan'
            ? 'who_bbtb_perempuan.json'
            : 'who_bbtb_laki.json'));

        // ✅ Cek apakah file ada
        if (!file_exists($file)) {
            return 'Data Tidak Tersedia (file tidak ditemukan: ' . $file . ')';
        }

        // ✅ Ambil data dari file JSON
        $data = json_decode(file_get_contents($file), true);

        // ✅ Pastikan data untuk tinggi badan tersebut tersedia
        if (!isset($data[$tb])) {
            return 'Data Tidak Tersedia (tidak ada data untuk tinggi ' . $tb . ' cm)';
        }

        $median = $data[$tb]['median'];
        $sd_minus_2 = $data[$tb]['sd_minus_2'];

        // ✅ Kategorisasi berdasarkan WHO Z-score (BB/TB)
        return match (true) {
            $bb < $sd_minus_2 => 'Gizi Buruk',
            $bb < $median     => 'Gizi Kurang',
            $bb == $median    => 'Normal',
            $bb > $median     => 'Risiko Gizi Lebih',
        };
    }
}
