<?php

namespace App\Services\Transcriptions;

use App\Models\Task;
use App\Models\Transcription;
use Illuminate\Support\Facades\Log;

class FakeTranscriptionService implements FakeTranscriptionServiceInterface
{
    /**
     * Генерирует фейковые результаты транскрибации и диоризации для задачи и сохраняет их в БД.
     *
     * @param Task $task
     * @return ?array
     */
    public function processDiarization(Task $task): array|null
    {
        try {
            $results = $this->generateFakeResults();
            foreach ($results as $result) {
                Transcription::create([
                    'task_id'    => $task->id,
                    'speaker'    => $result['speaker'],
                    'start_time' => $result['start'],
                    'end_time'   => $result['end'],
                    'text'       => $result['text'],
                ]);
            }
            return $results;
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return null;
        }
    }

    /**
     * Генерирует набор фейковых данных транскрибации и диоризации.
     *
     * @return array
     */
    private function generateFakeResults(): array
    {
        $results = [];
        $count = rand(20, 100);

        $sampleSentences = [
            'Добрый день, как я могу помочь?',
            'Здравствуйте, у меня проблема с заказом.',
            'Спасибо за звонок.',
            'Пожалуйста, подождите, я проверю информацию.',
            'Ваш запрос принят, ожидайте ответа.',
            'Вас обслуживает оператор.',
            'Пожалуйста, уточните ваш вопрос.',
            'Наш сервис работает.',
            'Обратитесь позже.',
            'Проверка данных...'
        ];

        for ($i = 0; $i < $count; $i++) {
            $start = round(rand(0, 30000) / 100, 2);
            $duration = round(rand(50, 1000) / 100, 2);
            $end = round($start + $duration, 2);
            $speaker = 'S' . rand(1, 3);
            $text = $sampleSentences[array_rand($sampleSentences)];
            $results[] = [
                'speaker' => $speaker,
                'start'   => $start,
                'end'     => $end,
                'text'    => $text,
            ];
        }
        return $results;
    }

}
