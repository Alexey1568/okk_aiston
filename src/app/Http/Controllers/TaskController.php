<?php

namespace App\Http\Controllers;

use App\Exceptions\TaskSaveException;
use App\Models\Task;
use App\Services\FakeStatus\FakeStatusService;
use App\Services\FakeStatus\FakeStatusServiceInterface;
use App\Services\Tasks\TaskServiceInterface;
use App\Http\Requests\TaskCreateRequest;
use App\DTO\Task\TaskDTO;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    private TaskServiceInterface $taskService;
    private FakeStatusServiceInterface $fakeStatusService;

    public function __construct(TaskServiceInterface $taskService, FakeStatusServiceInterface $fakeStatusService)
    {
        $this->taskService = $taskService;
        $this->fakeStatusService = $fakeStatusService;
    }

    public function create(TaskCreateRequest $request)
    {
        $taskDTO = new TaskDTO(
            $request->audio_url,
            $request->status ?? 'new',
            $request->metadata ?? null
        );
        try {
            $this->taskService->createTask($taskDTO);
            return response()->json(['message' => 'Task created successfully.'], Response::HTTP_CREATED);
        } catch (TaskSaveException $exception) {
            Log::error($exception->getMessage(),[
                'code' => $exception->getCode(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
            ]);
            return response()->json(['error' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getTaskStatus(Task $task)
    {

    }


}
