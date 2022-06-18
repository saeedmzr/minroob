<?php

namespace Saeed\Baloot;

use Carbon\Laravel\ServiceProvider;

class MinRoobProvider extends ServiceProvider
{

    public function boot()
    {
        $this->app->singleton(MinRoob::class);
    }

    public function register()
    {
//        $this->app->bind(MinRoob::class);

    }
}
