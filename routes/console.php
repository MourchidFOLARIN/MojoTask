<?php
use App\Models\Task;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskReminderMail;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\TaskReminder;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
Schedule::call(function () {
    $reminders = TaskReminder::where('enabled', true)
        ->where('active', true)
        ->whereHas('task', function ($query) {
            $query->where('completed', false)
                  ->where('due_date', '<', now());
        })
        ->get(); 
    foreach ($reminders as $reminder) {
        Mail::to($reminder->task->user->email)
            ->send(new TaskReminderMail($reminder->task));
        $reminder->update([
            'last_sent_at' => now(),
            'sent_count' => $reminder->sent_count + 1
        ]);
    }
    
})->hourly();
