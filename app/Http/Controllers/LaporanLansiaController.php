<?php

namespace App\Http\Controllers;

use App\Models\PencatatanLansia;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanLansiaController extends Controller
{
  public function exportLansiaPdf(Request $request)
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
            'lansia' => PencatatanLansia::with('lansia')
                        ->whereBetween('tanggal_posyandu', [$start, $end])
                        ->get(),
                        'qrBase64' => $qrBase64,
    ];

     $pdf = Pdf::loadView('laporan.lansia.pdf', $data)->setPaper('a4', 'landscape');

    return $pdf->stream('laporan-lansia-pdf.pdf');
}
}