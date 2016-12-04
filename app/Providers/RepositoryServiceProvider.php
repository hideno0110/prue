<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(\App\Repositories\AdminContactRepository::class, \App\Repositories\AdminContactRepositoryEloquent::class);
        // $this->app->bind(\App\Repositories\AdminContactRepository::class, \App\Repositories\AdminContactRepositoryEloquent::class);
        //:end-bindings:

        $repositories = [
            \App\Repositories\AdminContactRepository::class,
        ];

        foreach ($repositories as $repository) {
            $this->app->bind($repository, $repository.'Eloquent');
        }


    }
}
