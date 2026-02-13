<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/user', function () {
    return view('user');
})->name('user');
Route::get('/report', function () {
    return view('report');
})->name('report');


Route::get('/admin', function () {
    return view('admin');
})->name('admin');