<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BalitaExport;

class BalitaExportController extends Controller
{
    public function export()
    {
        return Excel::download(new BalitaExport, 'data-balita.xlsx');
    }
}

