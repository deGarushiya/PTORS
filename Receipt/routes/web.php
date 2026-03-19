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
        $hospitals = \App\Models\Hospital::ordered()->get() ?? collect();
        $accountCodes = \App\Models\AccountCode::ordered()->get() ?? collect();

        $hospitalTrustAccounts = collect();
        $hospitalGeneralAccounts = collect();
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('hospital_trust_accounts')) {
                $hospitalTrustAccounts = \App\Models\HospitalTrustAccount::ordered()->get()->map(fn ($t) => ['name' => $t->name, 'account_code' => $t->account_code]);
            }
            if (\Illuminate\Support\Facades\Schema::hasTable('hospital_general_accounts')) {
                $hospitalGeneralAccounts = \App\Models\HospitalGeneralAccount::ordered()->with('hospital')->get()->map(fn ($g) => ['name' => $g->hospital ? $g->hospital->name : '', 'account_code' => $g->account_code]);
            }
        } catch (\Throwable $e) {
            // use fallback below
        }
        if ($hospitalTrustAccounts->isEmpty() && $hospitalGeneralAccounts->isEmpty() && $hospitals->isNotEmpty()) {
            if (\Illuminate\Support\Facades\Schema::hasColumn('hospitals', 'trust_account_code')) {
                $hospitalTrustAccounts = $hospitals->filter(fn ($h) => !empty($h->trust_account_code))->map(fn ($h) => ['name' => $h->name, 'account_code' => $h->trust_account_code]);
            }
            if (\Illuminate\Support\Facades\Schema::hasColumn('hospitals', 'general_account_code')) {
                $hospitalGeneralAccounts = $hospitals->filter(fn ($h) => !empty($h->general_account_code))->map(fn ($h) => ['name' => $h->name, 'account_code' => $h->general_account_code]);
            }
        }

        return view('user', [
            'office' => $office,
            'particulars' => $particulars,
            'banks' => $banks,
            'hospitals' => $hospitals,
            'accountCodes' => $accountCodes,
            'hospitalTrustAccounts' => $hospitalTrustAccounts,
            'hospitalGeneralAccounts' => $hospitalGeneralAccounts,
        ]);
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
    Route::post('/developer/hospitals', [DeveloperController::class, 'storeHospital'])->name('developer.hospitals.store');
    Route::delete('/developer/hospitals/{hospital}', [DeveloperController::class, 'destroyHospital'])->name('developer.hospitals.destroy');
    Route::post('/developer/account-codes', [DeveloperController::class, 'storeAccountCode'])->name('developer.account-codes.store');
    Route::delete('/developer/account-codes/{accountCode}', [DeveloperController::class, 'destroyAccountCode'])->name('developer.account-codes.destroy');
    Route::post('/developer/trust-accounts', [DeveloperController::class, 'storeTrustAccount'])->name('developer.trust-accounts.store');
    Route::delete('/developer/trust-accounts/{hospitalTrustAccount}', [DeveloperController::class, 'destroyTrustAccount'])->name('developer.trust-accounts.destroy');
    Route::post('/developer/general-accounts', [DeveloperController::class, 'storeGeneralAccount'])->name('developer.general-accounts.store');
    Route::delete('/developer/general-accounts/{hospitalGeneralAccount}', [DeveloperController::class, 'destroyGeneralAccount'])->name('developer.general-accounts.destroy');

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