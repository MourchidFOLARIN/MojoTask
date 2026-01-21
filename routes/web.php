<?php
use App\Mail\TaskReminderMail;
use App\Models\Task;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

Route::get('/', function () {
    return view('public.todo');
})->name('home');
Route::middleware('auth')->controller(TasksController::class)
    ->group(function () {
        Route::get('/tasks', 'index')->name('tasks.index');
        Route::get('/tasks/create', 'create')->name('tasks.create');
        Route::post('/tasks', 'store')->name('tasks.store');
        Route::delete('/tasks/{task}', 'destroy')->name('tasks.destroy');
        Route::get('/tasks/{task}/edit', 'edit')->name('tasks.edit');
        Route::put('/tasks/{task}', 'update')->name('tasks.update');
        Route::put('/tasks/{task}/completed', 'completed')->name('tasks.completed');
        Route::get('/tasks/{task}/show', 'show')->name('tasks.show');
        });
        Route::post('/logout',[TasksController::class,'logout'])
        ->name('logout');
        Route::get('/test-mail', function () {
        $task = Task::whereHas('reminder', function($query) {
            $query->where('enabled', true);
        })->first();
        if (!$task) {
            return "Aucune tâche avec rappel activé n'a été trouvée. Vérifie ta table task_reminders !";
        }
        Mail::to('mourchidolawale@gmail.com')->send(new TaskReminderMail($task));
        return "Regarde ta boîte mail ! Le message touchant a été envoyé car le rappel est activé.";
       });
       Route::controller(AuthController::class)
    ->group(function () {
        Route::get('/auth/google', 'redirectToGoogle')->name('auth.google');
        Route::get('auth/google/callback', 'handleGoogleCallback');
        Route::get('/login', 'login')->name('login');
        Route::post('/register', 'registerPost')->name('register.post');
        Route::get('/register', 'register')->name('register');
        Route::post('/login', 'loginPost')->name('login.post');
    });
