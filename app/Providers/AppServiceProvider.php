<?php
namespace App\Providers;

use App\Domains\Files\ImagesHelper;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ImagesHelper::class, function ($app) {
            return new ImagesHelper();
        });
    }

    public function boot()
    {
        //
    }
}
