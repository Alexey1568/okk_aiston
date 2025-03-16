<?php

namespace App\Services\FakeStatus;

use App\Models\Task;

interface FakeStatusServiceInterface
{
    public function checkTasksStatus(Task $task): array;
}
