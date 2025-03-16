<?php

namespace App\DTO\Task;

class TaskResultDTO
{
    public function __construct(
        public int    $taskId,
        public string $status,
        public array $transcription,
        public array $evaluations,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['taskId'],
            $data['status'],
            $data['transcription'],
            $data['evaluations'],
        );
    }
}
