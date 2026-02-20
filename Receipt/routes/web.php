<?php

use App\Http\Controllers\DeveloperController;
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
        $perPage = (int) request('per_page', 10);
        $perPage = in_array($perPage, [10, 25, 50, 100]) ? $perPage : 10;
        $search = trim((string) request('search', ''));
        $dateFrom = request('date_from');
        $dateTo = request('date_to');
        $paymentMethod = request('payment_method');
        $query = \App\Models\Receipt::active()->with(['office', 'issuer']);
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