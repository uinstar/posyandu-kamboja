<?php

namespace App\Http\Controllers;

use App\Models\PencatatanBalita;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanBalitaController extends Controller
{
    public function exportBalitaPdf(Request $request)
    {
        $tanggal = $request->tanggal;
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

        // ✅ Kirim data ke view
        $data = [
            'tanggal' => $tanggal,
            'balita' => PencatatanBalita::with('balita')
                ->whereBetween('tanggal_posyandu', [$start, $end])
                ->get(),
            'qrBase64' => $qrBase64,
        ];

        $pdf = Pdf::loadView('laporan.balita.pdf', $data)->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-balita.pdf');
    }
}
