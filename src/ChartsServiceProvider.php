<?php

namespace HeFengbao\Charts;

use Illuminate\Support\ServiceProvider;

class ChartsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Config/charts.php' => config_path('charts.php'),
        ], 'charts_config');

        $this->loadViewsFrom(__DIR__ . '/Views', 'charts');

        $this->publishes([
            __DIR__ . '/Views' => resource_path('views/vendor/charts'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                \HeFengbao\Charts\Commands\ChartsCommand::class
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/charts.php',
            'charts'
        );
    }
}