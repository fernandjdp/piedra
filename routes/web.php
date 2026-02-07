<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::livewire('/cashflow', 'pages::cashflow.index')->middleware(['auth', 'verified'])->name('cashflow.index');
Route::livewire('/cashflow/create', 'pages::cashflow.create')->middleware(['auth', 'verified'])->name('cashflow.create');
Route::livewire('/cashflow/edit/{id}', 'pages::cashflow.edit')->middleware(['auth', 'verified'])->name('cashflow.edit');

require __DIR__.'/settings.php';
