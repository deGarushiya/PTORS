<?php

use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\ReceiptController;
use App\Models\Office;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PrintController;

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
    Route::get('/receipts/{id}/print', [PrintController::class, 'print'])->name('receipts.print');
    Route::get('/user', function () {
        $office = Office::firstOrCreate(
            ['code' => 'TREASURY'],
            ['name' => 'Provincial Treasury Office', 'address' => null, 'contact' => null, 'is_active' => true]
        );
        $particulars = \App\Models\Particular::active()->ordered()->get() ?? collect();
        $banks = \App\Models\Bank::ordered()->get() ?? collect();
        return view('user', ['office' => $office, 'particulars' => $particulars, 'banks' => $banks]);
    })->name('user');

    Route::post('/receipts', [ReceiptController::class, 'store'])->name('receipts.store');
    Route::post('/receipts/cancelled', [ReceiptController::class, 'storeCancelled'])->name('receipts.storeCancelled');

    Route::get('/report', function () {
        $search = trim((string) request('search', ''));
        $dateParam = request('date');
        $paymentMethod = request('payment_method');

        if ($dateParam) {
            $date = \Carbon\Carbon::parse($dateParam)->startOfDay();
        } else {
            $latest = \App\Models\Receipt::active()->orderByDesc('receipt_date')->value('receipt_date');
            $date = $latest ? \Carbon\Carbon::parse($latest)->startOfDay() : now()->startOfDay();
        }
        $dateStr = $date->format('Y-m-d');

        $query = \App\Models\Receipt::active()->with(['office', 'issuer'])
            ->whereDate('receipt_date', $dateStr);
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('receipt_number', 'like', '%' . $search . '%')
                    ->orWhere('payer_name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        if ($paymentMethod && in_array($paymentMethod, ['Cash', 'Check', 'Money Order'])) {
            $query->where('payment_method', $paymentMethod);
        }
        $receipts = $query->orderByDesc('id')->get();

        $prevDay = $date->copy()->subDay()->format('Y-m-d');
        $nextDay = $date->copy()->addDay()->format('Y-m-d');

        return view('report', [
            'receipts' => $receipts,
            'search' => $search,
            'date' => $dateStr,
            'dateDisplay' => $date->format('F j, Y'),
            'paymentMethod' => $paymentMethod,
            'prevDay' => $prevDay,
            'nextDay' => $nextDay,
        ]);
    })->name('report');

    Route::get('/admin', function () {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('user')->with('error', 'You do not have access to the admin area.');
        }
        $receiptsCount = \App\Models\Receipt::active()->count();
        $receiptsTotal = \App\Models\Receipt::active()->sum('amount');
        return view('admin', [
            'receiptsCount' => $receiptsCount,
            'receiptsTotal' => $receiptsTotal,
        ]);
    })->name('admin');

    Route::get('/developer', [DeveloperController::class, 'index'])->name('developer');
    Route::post('/developer/particulars', [DeveloperController::class, 'storeParticular'])->name('developer.particulars.store');
    Route::put('/developer/particulars/{particular}', [DeveloperController::class, 'updateParticular'])->name('developer.particulars.update');
    Route::delete('/developer/particulars/{particular}', [DeveloperController::class, 'destroyParticular'])->name('developer.particulars.destroy');
    Route::post('/developer/banks', [DeveloperController::class, 'storeBank'])->name('developer.banks.store');
    Route::delete('/developer/banks/{bank}', [DeveloperController::class, 'destroyBank'])->name('developer.banks.destroy');

    Route::post('/admin/backup', function () {
        if (!Auth::user()->isAdmin()) {
            return back()->with('error', 'You do not have access.');
        }
        try {
            \Illuminate\Support\Facades\Artisan::call('backup:run');
            return back()->with('success', 'Backup completed successfully.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Backup failed: ' . $e->getMessage());
        }
    })->name('admin.backup');
});