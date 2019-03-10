<?php

namespace App\Providers;

use App\Services\Filter;
use Illuminate\Support\ServiceProvider;

class FilterServiceProvider extends ServiceProvider{
    
    public function boot(){
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('filter', function ($app) {
            return new Filter;
        });
    }
}
