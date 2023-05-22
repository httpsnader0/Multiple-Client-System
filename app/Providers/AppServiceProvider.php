<?php

namespace App\Providers;

use App\Support\Traits\MenuTrait;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    use MenuTrait;

    public function register(): void
    {
    }

    public function boot(): void
    {
        view()->composer('*', function ($view) {

            $view->with([
                'menu' => $this->menu(),
            ]);

        });
    }
}
