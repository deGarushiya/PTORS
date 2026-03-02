<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Particular;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('developer', ['particulars' => $particulars, 'banks' => $banks]);
    }

    public function storeParticular(Request $request): RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('user')->with('error', 'You do not have access.');
        }
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:particulars,name'],
            'modal_type' => ['nullable', 'string', 'in:settlement,liquidation'],
        ], [
            'name.unique' => 'This particular option already exists.',
        ]);
        $maxOrder = Particular::max('sort_order') ?? 0;
        Particular::create([
            'name' => $validated['name'],
            'modal_type' => $validated['modal_type'] ?? null,
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
            'modal_type' => ['nullable', 'string', 'in:settlement,liquidation'],
            'is_active' => ['boolean'],
        ]);
        $particular->update([
            'name' => $validated['name'],
            'modal_type' => $validated['modal_type'] ?? null,
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
}
