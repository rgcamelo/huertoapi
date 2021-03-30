<?php

namespace App\Providers;

use App\Models\Bed;
use App\Models\Ground;
use App\Models\Plant;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Observers\BedObserver;
use App\Observers\GroundObserver;
use App\Observers\PlantObserver;

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
        Schema::defaultStringLength(191);
        Bed::observe(BedObserver::class);
        Ground::observe(GroundObserver::class);
        Plant::observe(PlantObserver::class);
    }
}
