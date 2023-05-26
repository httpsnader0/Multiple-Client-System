<?php

use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('showLogin');
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::get('client-register', [RegisterController::class, 'clientRegister'])->name('client-register.index');
Route::post('client-register', [RegisterController::class, 'register'])->name('client-register.store');

Route::get('user-register', [RegisterController::class, 'userRegister'])->name('user-register.index');
Route::post('user-register', [RegisterController::class, 'register'])->name('user-register.store');