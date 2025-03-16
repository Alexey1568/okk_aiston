<?php

namespace App\Providers;

use App\Events\TaskCompleted;
use App\Listeners\ProcessCompletedTask;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        TaskCompleted::class => [
            ProcessCompletedTask::class,
        ],
    ];
}
