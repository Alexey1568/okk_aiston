<?php

namespace App\Providers;

use App\Services\Transcriptions\FakeTranscriptionService;
use App\Services\Transcriptions\FakeTranscriptionServiceInterface;
use Illuminate\Support\ServiceProvider;

class TranscriptionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(FakeTranscriptionServiceInterface::class, FakeTranscriptionService::class);
    }
}
