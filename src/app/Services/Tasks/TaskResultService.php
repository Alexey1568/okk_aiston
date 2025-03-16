<?php

namespace App\Services\Tasks;

use App\DTO\Task\TaskResultDTO;
use App\Repositories\Tasks\TaskRepositoryInterface;
use App\Models\Task;
class TaskResultService implements TaskResultInterface
{
    /**
     * @param Task $task
     *@return TaskResultDTO
     * @throws TaskNotFoundException
     */
    public function getResult(Task $task): TaskResultDTO
    {
        if (!$task->isEvaluated()) {
            throw new TaskNotFoundException("Task not found or not evaluated");
        }

        return new TaskResultDTO(
            taskId: $task->id,
            status: $task->status,
            transcription: $task->transcriptions()
                ->select(['speaker','start_time', 'end_time', 'text'])
                ->get()
                ->toArray(),
            evaluations: json_decode($task->evaluation->result, true),
        );
    }
}
