<?php

namespace App\Services\Tasks;

use App\DTO\Task\TaskDTO;
use App\Repositories\Tasks\TaskRepositoryInterface;

class TaskService implements TaskServiceInterface
{
    private TaskRepositoryInterface $repository;

    public function __construct(TaskRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function createTask(TaskDTO $taskDTO): bool
    {
        return $this->repository->save($taskDTO);
    }
}
