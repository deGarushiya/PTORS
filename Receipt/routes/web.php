<?php

use App\Http\Controllers\ReceiptController;
use App\Models\Office;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/', function (Request $request) {
    $request->validate([
        'username' => ['required', 'string'],
        'password' => ['required', 'string'],
    ]);

    if (Auth::attempt(['email' => $request->username, 'password' => $request->password], true)) {
        $request->session()->regenerate();
        return redirect()->intended(route('user'));
    }

    return back()->withErrors([
        'password' => 'Wrong password. Please try again.',
    ])->onlyInput('username');
})->name('login.submit');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/user', function () {
        $offices = Office::where('is_active', true)->orderBy('name')->get();
        return view('user', ['offices' => $offices ?? collect()]);
    })->name('user');

    Route::post('/receipts', [ReceiptController::class, 'store'])->name('receipts.store');

    Route::get('/report', function () {
        $perPage = (int) request('per_page', 10);
        $perPage = in_array($perPage, [10, 25, 50, 100]) ? $perPage : 10;
        $search = trim((string) request('search', ''));
        $dateFrom = request('date_from');
        $dateTo = request('date_to');
        $paymentMethod = request('payment_method');
        $query = \App\Models\Receipt::with(['office', 'issuer']);
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('receipt_number', 'like', '%' . $search . '%')
                    ->orWhere('payer_name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        if ($dateFrom) {
            $query->whereDate('receipt_date', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->whereDate('receipt_date', '<=', $dateTo);
        }
        if ($paymentMethod && in_array($paymentMethod, ['Cash', 'Check', 'Money Order'])) {
            $query->where('payment_method', $paymentMethod);
        }
        $receipts = $query->orderByDesc('receipt_date')
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();
        return view('report', [
            'receipts' => $receipts,
            'perPage' => $perPage,
            'search' => $search,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'paymentMethod' => $paymentMethod,
        ]);
    })->name('report');

    Route::get('/admin', function () {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('user')->with('error', 'You do not have access to the admin area.');
        }
        $receiptsCount = \App\Models\Receipt::count();
        $receiptsTotal = \App\Models\Receipt::sum('amount');
        $officesCount = \App\Models\Office::where('is_active', true)->count();
        return view('admin', [
            'receiptsCount' => $receiptsCount,
            'receiptsTotal' => $receiptsTotal,
            'officesCount' => $officesCount,
        ]);
    })->name('admin');
});