<?php

namespace App\Services\Tasks;

use App\DTO\Task\TaskResultDTO;
use App\Models\Task;

interface TaskResultInterface
{
    public function getResult(Task $task): TaskResultDTO;
}
