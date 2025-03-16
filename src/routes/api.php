<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [LoginController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout']);
});

//TASKS
Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'task'], function () {
    Route::post('/create', [TaskController::class, 'create']);
    Route::get('/status/{task}', [TaskController::class, 'getStatus']);
});
