<?php

namespace App\Providers;

use App\Models\Column;
use App\Observers\ColumnObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Column::observe( ColumnObserver::class);
    }
}
