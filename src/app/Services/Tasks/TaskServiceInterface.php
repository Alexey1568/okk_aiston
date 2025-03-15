<?php

namespace App\Services\Tasks;

use App\DTO\Task\TaskDTO;

interface TaskServiceInterface
{
    /**
     * Создаёт задачу на основе переданного DTO.
     *
     * @param TaskDTO $taskDTO
     * @return bool
     */
    public function createTask(TaskDTO $taskDTO): bool;
}
