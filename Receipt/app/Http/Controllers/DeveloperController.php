<?php

namespace App\Http\Controllers;

use App\Models\AccountCode;
use App\Models\Bank;
use App\Models\Hospital;
use App\Models\HospitalGeneralAccount;
use App\Models\HospitalTrustAccount;
use App\Models\Particular;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class DeveloperController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('user')->with('error', 'You do not have access.');
        }
        $particulars = Particular::ordered()->get();
        $banks = Bank::ordered()->get();
        $hospitals = Hospital::ordered()->get();
        $accountCodes = AccountCode::ordered()->get();
        $hospitalTrustAccounts = HospitalTrustAccount::ordered()->with('hospital')->get();
        $hospitalGeneralAccounts = HospitalGeneralAccount::ordered()->with('hospital')->get();
        return view('developer', [
            'particulars' => $particulars,
            'banks' => $banks,
            'hospitals' => $hospitals,
            'accountCodes' => $accountCodes,
            'hospitalTrustAccounts' => $hospitalTrustAccounts,
            'hospitalGeneralAccounts' => $hospitalGeneralAccounts,
        ]);
    }

    public function storeParticular(Request $request): RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('user')->with('error', 'You do not have access.');
        }
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:particulars,name'],
            'modal_type' => ['nullable', 'string', Rule::in(['', 'settlement', 'liquidation', 'trust', 'general'])],
        ], [
            'name.unique' => 'This particular option already exists.',
        ]);
        $maxOrder = Particular::max('sort_order') ?? 0;
        $modalType = isset($validated['modal_type']) && $validated['modal_type'] !== '' ? $validated['modal_type'] : null;
        Particular::create([
            'name' => $validated['name'],
            'modal_type' => $modalType,
            'sort_order' => $maxOrder + 1,
            'is_active' => true,
        ]);
        return redirect()->route('developer')->with('success', 'Particular option added successfully.');
    }

    public function updateParticular(Request $request, Particular $particular): RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('user')->with('error', 'You do not have access.');
        }
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:particulars,name,' . $particular->id],
            'modal_type' => ['nullable', 'string', Rule::in(['', 'settlement', 'liquidation', 'trust', 'general'])],
            'is_active' => ['boolean'],
        ]);
        $modalType = isset($validated['modal_type']) && $validated['modal_type'] !== '' ? $validated['modal_type'] : null;
        $particular->update([
            'name' => $validated['name'],
            'modal_type' => $modalType,
            'is_active' => $request->boolean('is_active', true),
        ]);
        return redirect()->route('developer')->with('success', 'Particular option updated.');
    }

    public function destroyParticular(Particular $particular): RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('user')->with('error', 'You do not have access.');
        }
        $particular->delete();
        return redirect()->route('developer')->with('success', 'Particular option removed.');
    }

    public function storeBank(Request $request): RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('user')->with('error', 'You do not have access.');
        }
        $validated = $request->validate([
            'bank_name' => ['required', 'string', 'max:255', 'unique:banks,name'],
        ], ['bank_name.unique' => 'This bank already exists.']);
        $maxOrder = Bank::max('sort_order') ?? 0;
        Bank::create(['name' => $validated['bank_name'], 'sort_order' => $maxOrder + 1]);
        return redirect()->route('developer')->with('success', 'Bank added successfully.');
    }

    public function destroyBank(Bank $bank): RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('user')->with('error', 'You do not have access.');
        }
        $bank->delete();
        return redirect()->route('developer')->with('success', 'Bank removed.');
    }

    public function storeHospital(Request $request): RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('user')->with('error', 'You do not have access.');
        }
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:hospitals,name'],
        ], ['name.unique' => 'This hospital already exists.']);
        $maxOrder = Hospital::max('sort_order') ?? 0;
        Hospital::create(['name' => $validated['name'], 'sort_order' => $maxOrder + 1]);
        return redirect()->route('developer')->with('success', 'Hospital added successfully.');
    }

    public function destroyHospital(Hospital $hospital): RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('user')->with('error', 'You do not have access.');
        }
        $hospital->delete();
        return redirect()->route('developer')->with('success', 'Hospital removed.');
    }

    public function storeAccountCode(Request $request): RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('user')->with('error', 'You do not have access.');
        }
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:account_codes,name'],
        ], ['name.unique' => 'This account code already exists.']);
        $maxOrder = AccountCode::max('sort_order') ?? 0;
        AccountCode::create(['name' => $validated['name'], 'sort_order' => $maxOrder + 1]);
        return redirect()->route('developer')->with('success', 'Account code added successfully.');
    }

    public function destroyAccountCode(AccountCode $accountCode): RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('user')->with('error', 'You do not have access.');
        }
        $accountCode->delete();
        return redirect()->route('developer')->with('success', 'Account code removed.');
    }

    public function storeTrustAccount(Request $request): RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('user')->with('error', 'You do not have access.');
        }
        $validated = $request->validate([
            'hospital_id' => ['required', 'exists:hospitals,id'],
            'name' => ['required', 'string', 'max:255'],
            'account_code' => ['required', 'string', 'max:100'],
        ]);
        $maxOrder = HospitalTrustAccount::max('sort_order') ?? 0;
        HospitalTrustAccount::create([
            'hospital_id' => $validated['hospital_id'],
            'name' => $validated['name'],
            'account_code' => $validated['account_code'],
            'sort_order' => $maxOrder + 1,
        ]);
        return redirect()->route('developer')->with('success', 'Trust Fund account added.');
    }

    public function destroyTrustAccount(HospitalTrustAccount $hospitalTrustAccount): RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('user')->with('error', 'You do not have access.');
        }
        $hospitalTrustAccount->delete();
        return redirect()->route('developer')->with('success', 'Trust Fund account removed.');
    }

    public function storeGeneralAccount(Request $request): RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('user')->with('error', 'You do not have access.');
        }
        $validated = $request->validate([
            'hospital_id' => ['required', 'exists:hospitals,id'],
            'account_code' => ['required', 'string', 'max:100'],
        ]);
        $maxOrder = HospitalGeneralAccount::max('sort_order') ?? 0;
        HospitalGeneralAccount::updateOrCreate(
            ['hospital_id' => $validated['hospital_id']],
            ['account_code' => $validated['account_code'], 'sort_order' => $maxOrder + 1]
        );
        return redirect()->route('developer')->with('success', 'General Fund account added/updated.');
    }

    public function destroyGeneralAccount(HospitalGeneralAccount $hospitalGeneralAccount): RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('user')->with('error', 'You do not have access.');
        }
        $hospitalGeneralAccount->delete();
        return redirect()->route('developer')->with('success', 'General Fund account removed.');
    }
}
