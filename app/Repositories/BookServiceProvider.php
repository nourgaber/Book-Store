<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BookRepository\BookRepositoryInterface;
use App\Repositories\Interfaces;

use App\Services\BookService;
use App\Services\Interfaces\BookServiceInterface;
class BookServiceProvider extends ServiceProvider
{
    /**
     * Register services.
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
            'App\Repositories\BookServiceInterface',
            'App\Repositories\BookService'
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
