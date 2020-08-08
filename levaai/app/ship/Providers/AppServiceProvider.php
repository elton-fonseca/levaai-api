<?php

namespace Ship\Providers;

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
        $this->app->singleton('Ship\Services\Cep\CepService', function($app) {
            $token = config('services.webmania.token');
            $url = config('services.webmania.url');

            return new \Ship\Services\Cep\Providers\WebManiaProvider($token, $url);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
