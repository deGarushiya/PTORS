<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Receipt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceiptController extends Controller
{
    /**
     * Store a new receipt.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'receipt_date' => ['required', 'date'],
            'payer_name' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'payment_method' => ['nullable', 'string', 'in:Cash,Check,Money Order'],
            'description' => ['nullable', 'string', 'max:500'],
            'receipt_number' => ['required', 'digits:7', 'unique:receipts,receipt_number'],
            'office_id' => ['required', 'exists:offices,id'],
        ], [
            'receipt_number.required' => 'Please input the OR number.',
            'receipt_number.digits' => 'The OR number must be exactly 7 digits.',
            'receipt_number.unique' => 'This OR number already exists.',
            'receipt_date.required' => 'Please select the receipt date.',
            'payer_name.required' => 'Please input the payor name.',
            'amount.required' => 'Please input the amount.',
            'amount.numeric' => 'Please enter a valid amount.',
            'amount.min' => 'Amount must be at least 0.',
        ]);

        $receiptNumber = trim($validated['receipt_number']);

        Receipt::create([
            'receipt_number' => $receiptNumber,
            'office_id' => $validated['office_id'],
            'issued_by' => Auth::id(),
            'payer_name' => $validated['payer_name'],
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'] ?? null,
            'description' => $validated['description'] ?? null,
            'notes' => null,
            'receipt_date' => $validated['receipt_date'],
        ]);

        return redirect()->route('user')->with('success', 'Receipt saved successfully.');
    }

    private function generateReceiptNumber(int $officeId): string
    {
        $year = date('Y');
        $count = Receipt::where('office_id', $officeId)
            ->whereYear('receipt_date', $year)
            ->count();

        return sprintf('OR-%s-%04d', $year, $count + 1);
    }
}
