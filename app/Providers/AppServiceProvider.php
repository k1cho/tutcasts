<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    

    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::if('hasStartedSeries', function($series) {
            return auth()->user()->hasStartedSeries($series);
        });

        Blade::if('admin', function() {
            return auth()->user()->isAdmin();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
