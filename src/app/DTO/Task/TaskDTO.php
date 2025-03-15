<?php

namespace App\DTO\Task;

class TaskDTO
{
    private readonly string $status;
    private readonly ?string $metadata;
    private readonly string $audioUrl;

    public function __construct( string $audioUrl, string $status = 'new',?string $metadata = null)
    {
        $this->status = $status;
        $this->metadata = $metadata;
        $this->audioUrl = $audioUrl;
        $this->validateAudioUrl();
    }

    /**
     * Валидирует значение audioUrl.
     *
     * @throws \InvalidArgumentException если audioUrl не является корректным URL.
     */
    private function validateAudioUrl(): void
    {
        if (filter_var($this->audioUrl, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException('audioUrl is not a valid URL.');
        }
    }

    /**
     * Преобразует DTO в массив для передачи в ORM.
     */
    public function toArray(): array
    {
        return [
            'status'   => $this->status,
            'metadata' => $this->metadata,
            'audio_url' => $this->audioUrl,
        ];
    }
}
