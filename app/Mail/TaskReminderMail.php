<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class TaskReminderMail extends Mailable
{
    // On passe la tâche à l'email
    public function __construct(public Task $task) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '⚠️ Rappel : Tâche en retard !',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.task_reminder',
        );
    }
}