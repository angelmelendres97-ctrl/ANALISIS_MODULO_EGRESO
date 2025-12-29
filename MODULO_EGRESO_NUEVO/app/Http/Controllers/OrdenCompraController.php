<?php

namespace App\Http\Controllers;

use App\Models\OrdenCompra;
// It's better to use the Facade alias if it's configured in app.php
// use Barryvdh\DomPDF\Facade\Pdf;
// If not, use the full class name and instantiate it.
// For this case I'll use the Facade as it is common practice.
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OrdenCompraController extends Controller
{
    /**
     * Generate and download a PDF for the given purchase order.
     *
     * @param  \App\Models\OrdenCompra  $ordenCompra
     * @return \Illuminate\Http\Response
     */
    public function descargarPdf(OrdenCompra $ordenCompra)
    {
        // It is a good practice to load all necessary relationships to avoid N+1 problems in the view.
        $ordenCompra->load('detalles', 'empresa');

        // The view 'pdfs.orden_compra' will be created in the next step.
        $pdf = Pdf::loadView('pdfs.orden_compra', ['ordenCompra' => $ordenCompra]);

        // Returns the PDF as a download.
        return $pdf->stream('orden-compra-' . $ordenCompra->id . '.pdf');
    }
}
