<?php

use App\Http\Controllers\Dashboard\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::resource('products', ProductController::class);
Route::group(['prefix' => 'products/{product}', 'as' => 'products.'], function () {
    Route::put('active', [ProductController::class, 'active'])->name('active');
    Route::post('buy', [ProductController::class, 'buy'])->name('buy');
});

Route::get('reports', [ProductController::class, 'reports'])->name('reports.index');
