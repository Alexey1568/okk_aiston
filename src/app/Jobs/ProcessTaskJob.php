<?php

namespace App\Jobs;

use App\Events\TaskCompleted;
use App\Models\Task;
use App\Services\FakeStatus\FakeStatusServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $fakeStatusService = app(FakeStatusServiceInterface::class);
        $tasks = Task::whereIN('status', ['new', 'in_progress'])->get();
        foreach ($tasks as $task) {
            $fakeStatus = $fakeStatusService->checkTasksStatus($task);

            if (is_null($fakeStatus)) {
                continue;
            }
            if ($fakeStatus['status'] === 'completed') {
                $task->status = 'completed';
                $task->save();
                event(new TaskCompleted($task));
            } else {
                $task->status = $fakeStatus['status'];
                $task->save();
            }
        }
    }
}
