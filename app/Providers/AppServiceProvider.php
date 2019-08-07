<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\BookRepositoryInterface',
            'App\Repositories\BookRepository'
        );

        $this->app->bind(
            'App\Services\Interfaces\BookServiceInterface',
            'App\Services\BookService'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
