<?php

namespace App\Repositories\Tasks;

use App\DTO\Task\TaskDTO;

interface TaskRepositoryInterface
{
    /**
     * Сохраняет задачу.
     *
     * @param TaskDTO $taskDTO
     * @return bool
     */
    public function save(TaskDTO $taskDTO): bool;
}
