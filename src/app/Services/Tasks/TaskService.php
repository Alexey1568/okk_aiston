<?php

namespace App\Services\Tasks;

use App\DTO\Task\TaskDTO;
use App\Jobs\ProcessTaskJob;
use App\Models\Task;
use App\Repositories\Tasks\TaskRepositoryInterface;

class TaskService implements TaskServiceInterface
{
    private TaskRepositoryInterface $repository;

    public function __construct(TaskRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Создаём задачу и сразу ставим Job в очередь
     */
    public function createTask(TaskDTO $taskDTO): Task
    {
        $task = $this->repository->saveAndReturnModel($taskDTO);
        ProcessTaskJob::dispatch($task);
        return $task;
    }

}
