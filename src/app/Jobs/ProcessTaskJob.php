<?php

namespace App\Jobs;

use App\Models\Task;
use App\Services\Transcriptions\FakeTranscriptionServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Task $task;
    protected FakeTranscriptionServiceInterface $transcriptionService;

    /**
     * Создаём Job с привязкой к модели Task.
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Логика обработки задачи.
     */
    public function handle(FakeTranscriptionServiceInterface $transcriptionService)
    {
        $this->task->update(['status' => 'processing']);
        sleep(5);
        $transcriptionService->process($this->task);
    }
}
