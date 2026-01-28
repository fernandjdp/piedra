<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('cashflow', 'cashflow')
->middleware(['auth', 'verified'])
->name('cashflow');

require __DIR__.'/settings.php';
