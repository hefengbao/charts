<?php

namespace HeFengbao\Charts;

use Illuminate\Support\ServiceProvider;

class ChartsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'charts');

        $this->publishes([
            __DIR__ . '/Views' => resource_path('views/vendor/charts'),
        ]);
    }

    public function register()
    {

    }
}