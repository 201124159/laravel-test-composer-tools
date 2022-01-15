<?php

namespace Tutu\WebConfig;

use Illuminate\Support\ServiceProvider;

class WebConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        WebConfig::boot();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
