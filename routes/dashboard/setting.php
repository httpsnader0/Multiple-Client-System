<?php

use App\Http\Controllers\Dashboard\Setting\LogoController;
use Illuminate\Support\Facades\Route;

Route::get('logo', [LogoController::class, 'index'])->name('logo.index');
Route::put('logo', [LogoController::class, 'update'])->name('logo.update');
