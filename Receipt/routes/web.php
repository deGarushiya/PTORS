<?php

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
        return view('user');
    })->name('user');

    Route::get('/report', function () {
        return view('report', ['perPage' => request('per_page', 10)]);
    })->name('report');
});