<?php

namespace App\Providers;

use App\Service\ParsingService;
use Illuminate\Support\ServiceProvider;

class ParsingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ParsingService::class, function(){
            return new ParsingService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
