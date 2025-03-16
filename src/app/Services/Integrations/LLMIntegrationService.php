<?php

namespace App\Services\Integrations;

use App\Models\Log;
use App\Models\Task;
use App\Services\LLM\FakeLLMServiceInterface;

class LLMIntegrationService
{
    public function __construct(
        private FakeLLMServiceInterface $fakeLLMService
    ) {}

    public function callEvaluateQuality(array $diarizationData, Task $task): ?array
    {
        try {
            $response = $this->fakeLLMService->evaluateQuality($diarizationData);
            Log::create([
                'task_id' => $task->id,
                'level'   => 'info',
                'message' => 'Вызов оценки качества успешен',
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
            $task->status = 'evaluate_error';
            $task->save();
            return null;
        }
    }
}
