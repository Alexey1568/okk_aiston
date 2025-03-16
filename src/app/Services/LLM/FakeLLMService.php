<?php

namespace App\Services\LLM;

class FakeLLMService implements FakeLLMServiceInterface
{
    public function evaluateQuality(array $diarizationData): array
    {
        $qualityScore = random_int(1, 100);
        $commentsPool = [
            'Отличное качество транскрибации.',
            'Хорошее качество, есть небольшие недочёты.',
            'Удовлетворительное качество, но требуется доработка.',
            'Плохое качество транскрибации, требуется улучшение.',
            'Выдающееся качество, никаких нареканий!',
        ];

        $randomComment = $commentsPool[array_rand($commentsPool)];

        return [
            'quality_score' => $qualityScore,
            'comments' => $randomComment,
            'segments_count' => count($diarizationData),
        ];
    }
}
