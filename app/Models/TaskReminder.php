<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskReminder extends Model
{
    // On ajoute toutes les colonnes présentes dans ta migration
    protected $fillable = [
        'task_id',
        'enabled',
        'last_sent_at',
        'sent_count',
        'active',
    ];

    // On indique à Laravel de traiter last_sent_at comme une date Carbon
    protected $casts = [
        'last_sent_at' => 'datetime',
        'enabled' => 'boolean',
        'active' => 'boolean',
    ];

    // 🔗 Un rappel appartient à une tâche
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
    public function reminder()
    {
        return $this->hasOne(TaskReminder::class);
    }
}
