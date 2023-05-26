<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {

    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {

        require __DIR__ . '/auth.php';

        Route::group(['middleware' => ['auth']], function () {

            require __DIR__ . '/core.php';

            require __DIR__ . '/profile.php';

            require __DIR__ . '/product.php';

            require __DIR__ . '/user.php';

            require __DIR__ . '/setting.php';

        });

    });

});
