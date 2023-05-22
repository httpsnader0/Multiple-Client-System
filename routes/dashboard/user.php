<?php

use App\Http\Controllers\Dashboard\User\AdministratorController;
use App\Http\Controllers\Dashboard\User\CustomerServiceController;
use App\Http\Controllers\Dashboard\User\RoleController;
use App\Http\Controllers\Dashboard\User\ClientController;
use App\Http\Controllers\Dashboard\User\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('roles', RoleController::class);
Route::group(['prefix' => 'roles/{role}', 'as' => 'roles.'], function () {
    Route::put('active', [RoleController::class, 'active'])->name('active');
});

Route::resource('administrators', AdministratorController::class);
Route::group(['prefix' => 'administrators/{administrator}', 'as' => 'administrators.'], function () {
    Route::put('active', [AdministratorController::class, 'active'])->name('active');
});

Route::resource('customer-services', CustomerServiceController::class);
Route::group(['prefix' => 'customer-services/{customerService}', 'as' => 'customer-services.'], function () {
    Route::put('active', [CustomerServiceController::class, 'active'])->name('active');
});

Route::resource('users', UserController::class)->except(['create', 'edit']);
Route::group(['prefix' => 'users/{user}', 'as' => 'users.'], function () {
    Route::put('active', [UserController::class, 'active'])->name('active');
});

Route::resource('clients', ClientController::class)->except(['create', 'edit']);
Route::group(['prefix' => 'clients/{client}', 'as' => 'clients.'], function () {
    Route::put('active', [ClientController::class, 'active'])->name('active');
});
