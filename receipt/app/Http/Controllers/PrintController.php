<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Receipt;

class PrintController extends Controller
{
    public function print($id)
    {
        $receipt = Receipt::findOrFail($id);

        $pdf = Pdf::loadView('receipts.print', compact('receipt'));

        return $pdf->stream('official_receipt_'.$receipt->receipt_number.'.pdf');
    }
}