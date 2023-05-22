<?php

use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Profile\ChangePasswordController;
use App\Http\Controllers\Dashboard\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {

    Route::get('/', [ProfileController::class, 'index'])->name('index');

    Route::group(['prefix' => 'change-passwords', 'as' => 'change-passwords.'], function () {

        Route::get('/', [ChangePasswordController::class, 'index'])->name('index');
        Route::put('/', [ChangePasswordController::class, 'update'])->name('update');

    });

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

});
