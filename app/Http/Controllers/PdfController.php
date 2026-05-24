<?php
namespace App\Http\Controllers;

use App\Models\Renta;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function reporteRentas()
    {
        $rentas = Renta::with(['cliente', 'pelicula'])->get();

        $pdf = Pdf::loadView('pdf.rentas', compact('rentas'))
                  ->setPaper('a4', 'landscape');

        return $pdf->stream('reporte-rentas.pdf');
    }
}