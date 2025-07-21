<?php

namespace App\Http\Controllers;

use App\Models\PencatatanIbuHamil;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanIbuHamilController extends Controller
{
  public function exportIbuHamilPdf(Request $request)
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

    $data = [
            'tanggal' => $tanggal,
            'ibuhamil' => PencatatanIbuHamil::with('ibuHamil')
                        ->whereBetween('tanggal_posyandu', [$start, $end])
                        ->get(),
                        'qrBase64' => $qrBase64,
    ];

     $pdf = Pdf::loadView('laporan.ibuhamil.pdf', $data)->setPaper('a4', 'landscape');

    return $pdf->stream('laporan-ibu-hamil-pdf.pdf');
}
}