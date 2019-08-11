<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EloquentRepositoryProvider extends ServiceProvider
{
    // protected $defer = true;
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'App\Contracts\Repositories\CategoryRepositoryInterface', 
            'App\Repositories\Eloquent\CategoryRepository'
        );  
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
