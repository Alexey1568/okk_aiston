<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            // Ссылка на аудиофайл или иной идентификатор
            $table->string('audio_url')->nullable();
            // Статус задачи (new, in_progress, done, error и т.д.)
            $table->string('status')->default('new');
            // Дополнительные параметры задачи в формате JSON
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
