<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();

            // Не все логи обязательно связаны с конкретной задачей
            $table->foreignId('task_id')
                ->nullable()
                ->constrained('tasks')
                ->onDelete('cascade');

            // Уровень лога (info, error, debug, etc.)
            $table->string('level')->default('info');

            // Основное сообщение (что произошло)
            $table->text('message');

            // Дополнительный контекст в виде JSON
            $table->json('context')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('logs');
    }
};
