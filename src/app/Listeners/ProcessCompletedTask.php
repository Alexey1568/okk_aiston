<?php

namespace App\Listeners;

use App\Events\TaskCompleted;
use App\Services\Transcriptions\FakeTranscriptionServiceInterface;
use App\Services\LLM\FakeLLMServiceInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
class ProcessCompletedTask
{
    use InteractsWithQueue;
    private FakeTranscriptionServiceInterface $transcriptionService;
    private FakeLLMServiceInterface $llmService;

    public function __construct(
        FakeTranscriptionServiceInterface $transcriptionService,
        FakeLLMServiceInterface $llmService
    ) {
        $this->transcriptionService = $transcriptionService;
        $this->llmService = $llmService;
    }

    public function handle(TaskCompleted $event)
    {
        $task = $event->task;
        $diarizationData = $this->transcriptionService->processDiarization($task);
        $llmResult = $this->llmService->evaluateQuality($diarizationData);
        $task->evaluation()->updateOrCreate(
            [],
            ['result' => json_encode($llmResult, JSON_UNESCAPED_UNICODE)]
        );
        $task->status = 'evaluated';
        $task->save();
        Log::info("Task {$task->id} обработана LLM, результат: " . json_encode($llmResult, JSON_UNESCAPED_UNICODE));
    }
}
