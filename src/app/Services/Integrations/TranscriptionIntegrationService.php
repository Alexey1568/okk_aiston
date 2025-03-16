<?php

namespace App\Services\Integrations;

use App\Models\Log;
use App\Models\Task;
use App\Services\Transcriptions\FakeTranscriptionServiceInterface;

class TranscriptionIntegrationService
{
    public function __construct(
        private FakeTranscriptionServiceInterface $transcriptionService
    ) {}

    public function callProcessDiarization(Task $task): ?array
    {
        try {
            $response = $this->transcriptionService->processDiarization($task);
            Log::create([
                'task_id' => $task->id,
                'level'   => 'info',
                'message' => 'Вызов транскрибации успешен',
                'context' => ['response' => $response],
            ]);
            return $response;
        } catch (\Exception $e) {
            Log::create([
                'task_id' => $task->id,
                'level'   => 'error',
                'message' => 'Ошибка: ' . $e->getMessage(),
                'context' => ['trace' => $e->getTraceAsString()],
            ]);
            $task->status = 'transcription_error';
            $task->save();
            return null;
        }
    }
}
