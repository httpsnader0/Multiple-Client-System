<?php

use App\Http\Controllers\Dashboard\Core\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');
