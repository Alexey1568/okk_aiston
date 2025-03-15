<?php

namespace App\Repositories\Tasks;

use App\DTO\Task\TaskDTO;
use App\Exceptions\TaskSaveException;
use App\Models\Task;
use Exception;

class TaskRepository implements TaskRepositoryInterface
{
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

    /**
     * Сохраняет задачу и возвращает объект модели Task.
     *
     * @param TaskDTO $taskDTO
     * @return Task
     *
     * @throws TaskSaveException
     */
    public function saveAndReturnModel(TaskDTO $taskDTO): Task
    {
        try {
            $task = Task::create($taskDTO->toArray());
            return $task;
        } catch (Exception $exception) {
            \Log::error($exception->getMessage());
            throw new TaskSaveException("Failed to save task.", 0, $exception);
        }
    }
}
