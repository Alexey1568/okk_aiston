<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResultResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'status' => $this->status,
            'data' => $this->status === 'completed'
                ? $this->transcriptions->map(fn($transcription) =>[
                    'speaker' => $transcription->speaker,
                    'start' => $transcription->start_time,
                    'end' => $transcription->end_time,
                    'text' => $transcription->text,
            ])  : null,
        ];
    }
}
