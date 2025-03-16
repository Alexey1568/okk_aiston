<?php

namespace App\Providers;

use App\Services\LLM\FakeLLMService;
use App\Services\LLM\FakeLLMServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FakeLLMServiceInterface::class, FakeLLMService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
