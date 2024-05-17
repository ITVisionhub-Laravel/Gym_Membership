<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //Bind the contracts and repositories
        $this->app->bind(
            'App\Contracts\LocationInterface',
            'App\Repositories\LocationRepository'
        );

        $this->app->bind(
            'App\Contracts\ExpenseInterface',
            'App\Repositories\ExpenseRepository'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
