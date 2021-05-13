<?php

namespace App\Providers;

use App\Models\Bed;
use App\Models\Ground;
use App\Models\Plant;
use App\Models\Seed;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Observers\BedObserver;
use App\Observers\GroundObserver;
use App\Observers\PlantObserver;
use Illuminate\Contracts\Routing\UrlGenerator;

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
    public function boot(UrlGenerator $url)
    {
        if(env('REDIRECT_HTTPS')){
            $this->app['request']->server->set('HTTPS',true);
        }
        Schema::defaultStringLength(191);
        Bed::observe(BedObserver::class);
        Ground::observe(GroundObserver::class);
        Plant::observe(PlantObserver::class);
        Seed::observe(SeedObserver::class);
    }
}
