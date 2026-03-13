<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Receipt;
use Dompdf\Adapter\CPDF;

class PrintController extends Controller
{
    public function print($id)
    {
        $receipt = Receipt::with('office')->findOrFail($id);

        $amountInWords = self::amountToWords((float) $receipt->amount);
        $fundCode = self::fundCodeForReceipt($receipt);

        $pdf = Pdf::loadView('receipts.print', [
            'receipt' => $receipt,
            'amountInWords' => $amountInWords,
            'fundCode' => $fundCode,
        ]);

        $pdf->render();
        $canvas = $pdf->getDomPDF()->get_canvas();
        if ($canvas instanceof CPDF) {
            $canvas->get_cpdf()->setPreferences('PrintScaling', 'None');
        }

        return $pdf->stream('official_receipt_'.$receipt->receipt_number.'.pdf');
    }

   // Trust Fund → 300, otherwise office fund_code (default 100).

    private static function fundCodeForReceipt(Receipt $receipt): string
    {
        if (trim((string) ($receipt->description ?? '')) === 'Trust Fund') {
            return '300';
        }
        return $receipt->office?->fund_code ?? '100';
    }

    // dito yna yung amount in words na print
    private static function amountToWords(float $amount): string
    {
        $intPart = (int) floor($amount);
        $centavos = (int) round(($amount - $intPart) * 100);
        if ($centavos >= 100) {
            $centavos = 0;
        }
        $words = self::intToWords($intPart);
        $centavosStr = str_pad((string) $centavos, 2, '0', STR_PAD_LEFT);
        return $words . ' and ' . $centavosStr . '/100 pesos only';
    }

    private static function intToWords(int $n): string
    {
        if ($n === 0) {
            return 'Zero';
        }
        $ones = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten',
            'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
        $tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
        if ($n < 20) {
            return $ones[$n];
        }
        if ($n < 100) {
            return trim($tens[(int) floor($n / 10)] . ' ' . $ones[$n % 10]);
        }
        if ($n < 1000) {
            $h = (int) floor($n / 100);
            $r = $n % 100;
            return trim($ones[$h] . ' Hundred' . ($r ? ' ' . self::intToWords($r) : ''));
        }
        if ($n < 1_000_000) {
            $th = (int) floor($n / 1000);
            $r = $n % 1000;
            return trim(self::intToWords($th) . ' Thousand' . ($r ? ' ' . self::intToWords($r) : ''));
        }
        if ($n < 1_000_000_000) {
            $m = (int) floor($n / 1_000_000);
            $r = $n % 1_000_000;
            return trim(self::intToWords($m) . ' Million' . ($r ? ' ' . self::intToWords($r) : ''));
        }
        $b = (int) floor($n / 1_000_000_000);
        $r = $n % 1_000_000_000;
        return trim(self::intToWords($b) . ' Billion' . ($r ? ' ' . self::intToWords($r) : ''));
    }
}