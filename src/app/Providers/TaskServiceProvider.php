<?php

namespace App\Providers;

use App\Repositories\Tasks\TaskRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\Tasks\TaskServiceInterface;
use App\Services\Tasks\TaskService;
use App\Repositories\Tasks\TaskRepository;

class TaskServiceProvider extends ServiceProvider
{
    /**
     * Регистрация привязок в контейнере.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TaskServiceInterface::class, TaskService::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
    }

    /**
     * Выполнение загрузки сервисов.
     *
     * @return void
     */
    public function boot()
    {
    }
}
