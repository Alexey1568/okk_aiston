<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();

            // Ссылка на задачу
            $table->foreignId('task_id')
                ->constrained('tasks')
                ->onDelete('cascade');

            // Результат оценки качества разговора (LLM)
            // Можно хранить в json (если много структурированной инфы)
            $table->json('result')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
};
