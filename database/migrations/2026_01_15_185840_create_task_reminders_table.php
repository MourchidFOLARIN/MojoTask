<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
 public function up(): void
{
    Schema::create('task_reminders', function (Blueprint $table) {
        $table->id();

        $table->foreignId('task_id')
              ->constrained()
              ->cascadeOnDelete();

        // L’utilisateur veut recevoir des rappels ?
        $table->boolean('enabled')->default(true);

        // Dernier rappel envoyé
        $table->timestamp('last_sent_at')->nullable();

        // Nombre total de rappels envoyés
        $table->unsignedInteger('sent_count')->default(0);

        // Le rappel est-il toujours actif ?
        $table->boolean('active')->default(true);

        $table->timestamps();
    });
}


    
    public function down(): void
    {
        Schema::dropIfExists('task_reminders');
    }
};
