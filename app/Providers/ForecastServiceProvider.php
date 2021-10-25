<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ForecastApi;
class ForecastServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('forecast', function() {
            return new ForecastApi();
        });
    }
}
