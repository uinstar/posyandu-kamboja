<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PencatatanBalita;
use App\Models\PencatatanIbuHamil;
use App\Models\PencatatanLansia;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function exportPdf(Request $request)
    {
        $tanggal = $request->tanggal;

        // Konversi tanggal string ke awal dan akhir bulan
        $start = Carbon::parse($tanggal)->startOfMonth();
        $end = Carbon::parse($tanggal)->endOfMonth();
        // ✅ Ambil QR code dalam bentuk base64
        $path = public_path('bg/qrcode.jpg');
        $qrBase64 = null;

        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $qrBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }
        $data = [
            'tanggal' => $tanggal,
            'balita' => PencatatanBalita::with('balita')
                        ->whereBetween('tanggal_posyandu', [$start, $end])
                        ->get(),
            'ibuhamil' => PencatatanIbuHamil::with('ibuHamil')
                        ->whereBetween('tanggal_posyandu', [$start, $end])
                        ->get(),
            'lansia' => PencatatanLansia::with('lansia')
                        ->whereBetween('tanggal_posyandu', [$start, $end])
                        ->get(),
                        'qrBase64' => $qrBase64,
        ];

        $pdf = Pdf::loadView('laporan.pdf', $data)->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-posyandu.pdf');
    }
}
