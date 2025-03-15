<?php

namespace App\Services\Tasks;

use App\DTO\Task\TaskDTO;
use App\Models\Task;

interface TaskServiceInterface
{
    /**
     * Создаёт задачу на основе переданного DTO.
     *
     * @param TaskDTO $taskDTO
     * @return Task
     */
    public function createTask(TaskDTO $taskDTO): Task;
}
