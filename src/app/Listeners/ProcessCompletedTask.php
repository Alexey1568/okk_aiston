<?php

namespace App\Listeners;

use App\Events\TaskCompleted;
use App\Services\Integrations\LLMIntegrationService;
use App\Services\Integrations\TranscriptionIntegrationService;
use App\Services\Transcriptions\FakeTranscriptionServiceInterface;
use App\Services\LLM\FakeLLMServiceInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
class ProcessCompletedTask
{
    use InteractsWithQueue;


    public function __construct(
        private TranscriptionIntegrationService $transcriptionService,
        private LLMIntegrationService $llmIntegrationService,
    ) {

    }

    public function handle(TaskCompleted $event)
    {
        $task = $event->task;
        $diarizationData = $this->transcriptionService->callProcessDiarization($task);
        if (!$diarizationData) {
            return;
        }
        $llmResult = $this->llmIntegrationService->callEvaluateQuality($diarizationData, $task);
        $task->evaluation()->updateOrCreate(
            [],
            ['result' => json_encode($llmResult, JSON_UNESCAPED_UNICODE)]
        );
        $task->status = 'evaluated';
        $task->save();
    }
}
