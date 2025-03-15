<?php

namespace App\Repositories\Tasks;

use App\DTO\Task\TaskDTO;
use App\Models\Task;

interface TaskRepositoryInterface
{
    /**
     * Сохраняет задачу в базе данных, возвращает bool.
     */
    public function save(TaskDTO $taskDTO): bool;

    /**
     * Сохраняет задачу и возвращает объект модели Task.
     */
    public function saveAndReturnModel(TaskDTO $taskDTO): Task;
}
