<?php

namespace App\Services\Transcriptions;

use App\Models\Task;

interface FakeTranscriptionServiceInterface
{
    public function process(Task $task);
}
