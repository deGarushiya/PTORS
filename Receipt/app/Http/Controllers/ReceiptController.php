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

        return redirect()->route('user')
            ->with('success', 'Receipt saved successfully.')
            ->with('success_receipt_saved', true);
    }

    /**
     * Store a cancelled OR record.
     */
    public function storeCancelled(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'receipt_number' => ['required', 'digits:7', 'unique:receipts,receipt_number'],
            'receipt_date' => ['required', 'date'],
            'office_id' => ['required', 'exists:offices,id'],
            'cancelled_reason' => ['nullable', 'string', 'max:500'],
        ], [
            'receipt_number.required' => 'Please input the OR number.',
            'receipt_number.digits' => 'The OR number must be exactly 7 digits.',
            'receipt_number.unique' => 'This OR number already exists.',
        ]);

        Receipt::create([
            'receipt_number' => trim($validated['receipt_number']),
            'office_id' => $validated['office_id'],
            'issued_by' => Auth::id(),
            'payer_name' => 'CANCELLED OR',
            'amount' => 0,
            'payment_method' => null,
            'description' => 'Cancelled official receipt',
            'notes' => $validated['cancelled_reason'] ?? null,
            'receipt_date' => $validated['receipt_date'],
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'cancelled_reason' => $validated['cancelled_reason'] ?? null,
        ]);

        return redirect()->route('user')->with('success', 'Cancelled OR recorded successfully.');
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
