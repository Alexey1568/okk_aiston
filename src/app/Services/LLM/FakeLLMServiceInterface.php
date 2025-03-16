<?php

namespace App\Services\LLM;

interface FakeLLMServiceInterface
{
    public function evaluateQuality(array $diarizationData): array;
}
