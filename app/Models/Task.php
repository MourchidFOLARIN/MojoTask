<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'due_date',
        'due_at',
        'completed',
        'completed_at',
        'priority',
        'send_email_reminder',
        'whatsapp_number'
    ];
    protected $casts = [
    'due_date' => 'datetime',
    'completed' => 'boolean',
    'completed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reminders(): HasMany
    {
        return $this->hasMany(TaskReminder::class);
    }
    public function reminder(): HasOne
    {
       return $this->hasOne(TaskReminder::class);
    }
}
