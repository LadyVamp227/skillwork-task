<?php

namespace App\Providers;

use App\Http\Controllers\ArticlesController;
use App\Interfaces\ArticlesServiceAdapter;
use App\Services\ArticlesService;
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
        $this->app->when(ArticlesController::class)
            ->needs(ArticlesServiceAdapter::class)
            ->give(ArticlesService::class);
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
