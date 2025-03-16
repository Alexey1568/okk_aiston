<?php

namespace App\Services\FakeStatus;

use App\Models\Task;


class FakeStatusService implements FakeStatusServiceInterface
{
    public function checkTasksStatus(Task $task): array
    {
        $rand = rand(1, 10);
        $response = $rand < 6 ? 'in_progress' : 'completed';
        return ['status'=> $response];
    }
}
