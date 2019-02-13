<?php

namespace App\Providers;

use App\Services\Utilities\AppSlot;
use App\Services\Utilities\Color;
use App\Services\Utilities\Day;
use App\Services\Utilities\Specialty;
use App\Services\Utilities\Title;
use Illuminate\Support\ServiceProvider;

class UtilityServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Register a binding of the Title class with the related container.
         */
        $this->app->bind('title', function()
        {
            return new Title;
        });

        /**
         * Register a binding of the Specialty class with the related container.
         */
        $this->app->bind('specialty', function()
        {
            return new Specialty;
        });

        /**
         * Register a binding of the Color class with the related container.
         */
        $this->app->bind('color', function()
        {
            return new Color;
        });

        /**
         * Register a binding of the AppSlot class with the related container.
         */
        $this->app->bind('appSlot', function()
        {
            return new AppSlot;
        });

        /**
         * Register a binding of the Day class with the related container.
         */
        $this->app->bind('day', function()
        {
            return new Day;
        });
    }
}
