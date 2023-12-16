<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use jcobhams\NewsApi\NewsApi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require app_path('Helpers/helper.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $apiKey = config('services.news_providers.news_api_org.api_key');
        $this->app->bind(NewsApi::class, fn() => new NewsApi($apiKey));
    }
}
