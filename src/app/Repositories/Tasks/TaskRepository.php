<?php

namespace App\Repositories\Tasks;

use App\DTO\Task\TaskDTO;
use App\Exceptions\TaskSaveException;
use App\Models\Task;
use Exception;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * @throws TaskSaveException
     */
    public function save(TaskDTO $taskDTO): bool
    {
        try {
            Task::create($taskDTO->toArray());
            return true;
        } catch (Exception $exception) {
            \Log::error($exception->getMessage());
            throw new TaskSaveException("Failed to save task.", 0, $exception);
        }
    }
}
