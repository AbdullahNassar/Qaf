<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\I18N_Arabic::class, function(){
            $Arabic = new \I18N_Arabic('Date');
            $Arabic->setMode(3);
            return $Arabic;
        });
    }
}
