<?php

namespace App\Providers;

use App\Services\Transcriptions\FakeTranscriptionService;
use App\Services\Transcriptions\FakeTranscriptionServiceInterface;

class TranscriptionServiceProvider
{
    public function register()
    {
        $this->app->bind(FakeTranscriptionServiceInterface::class, FakeTranscriptionService::class);
    }
}
