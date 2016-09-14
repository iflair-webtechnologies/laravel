<?php

namespace Villato\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using Closure based composers...
        view()->composer('*', function ($view) {

            $title = $view->offsetExists('title') ? $view->offsetGet('title') : '';
            $view->with('title', $title);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}