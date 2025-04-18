<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PresencesExport;

class ExportController extends Controller
{
    /**
     * Exporter les présences en PDF
     */
    public function exportPDF()
    {
        $presences = Presence::with('user')->get();
        $pdf = PDF::loadView('exports.presences_pdf', compact('presences'));
        return $pdf->download('presences.pdf');
    }

    /**
     * Exporter les présences en Excel
     */
    public function exportExcel()
    {
        return Excel::download(new PresencesExport, 'presences.xlsx');
    }
}
