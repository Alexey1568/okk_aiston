<?php

namespace App\Repositories\Tasks;

use App\DTO\Task\TaskDTO;
use App\Models\Task;
use App\Exceptions\TaskSaveException;
use Exception;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * Сохраняет задачу в базе данных.
     *
     * @param TaskDTO $taskDTO
     * @return bool
     *
     * @throws TaskSaveException
     */
    public function save(TaskDTO $taskDTO): bool
    {
        try {
            Task::create($taskDTO->toArray());
            return true;
        } catch (Exception $exception) {
            throw new TaskSaveException(
                "Failed to save task. Original message: " . $exception->getMessage(),
                0,
                $exception
            );
        }
    }
}
