<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\TaskReminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $info = [
            'tasks'         => $user->tasks()->latest()->paginate(3),
            'taskSum'       => $user->tasks()->count(),
            'taskCompleted' => $user->tasks()->where('completed', true)->count(),
            'taskPending'   => $user->tasks()->where('completed', false)->where('due_date', '>', now())->count(),
            'taskOverdue'   => $user->tasks()->where('completed', false)->where('due_date', '<', now())->count(),
        ];

        return view('tasks.index', $info);
    }

    public function create()
    {
        return view('tasks.create');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'title'    => 'required|string|max:255',
                'due_date' => 'required|date|after:now',
                'whatsapp_number' => 'nullable|numeric|digits_between:8,15'
            ],
            [
                'title.required'    => 'Le titre est obligatoire.',
                'due_date.required' => "L'échéance est obligatoire.",
                'due_date.after'    => 'La date doit être dans le futur.',
                'whatsapp_number.numeric' => 'Le numéro WhatsApp ne doit contenir que des chiffres.',
                'whatsapp_number.digits_between' => 'Le numéro doit comporter entre 8 et 15 chiffres.',
            ]
        );
        $task = Task::create([
            'user_id'         => auth()->id(),
            'title'           => $request->title,
            'description'     => $request->description,
            'due_date'        => $request->due_date,
            'priority'        => $request->priority,
            'reminder'        => $request->has('reminder'),
            'whatsapp_number' => $request->whatsapp_number,
        ]);
        if ($request->has('reminder')) {
            TaskReminder::create([
                'task_id' => $task->id,
                'enabled' => true,
            ]);
        }

        return to_route('tasks.create')->with('success', 'Votre tâche a été ajoutée avec succès !');
    }
    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403, "Ceci n'est pas votre tâche !");
        }
        $task->delete();
        return redirect()->back()->with('success', 'La tâche a été supprimée !');
    }
    public function edit(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403, "Ceci n'est pas votre tâche !");
        }
        return view('tasks.edit', compact('task'));
    }
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => 'required',
            'priority'      => 'required|in:low,medium,high',
            'due_date'      => 'nullable|date',
        ]);
        $data = [
            'completed'     => false,
            'completed_at'  => null
        ];
        $task->update($data);
        return redirect()->route('tasks.index')->with('success', 'Mise à jour réussie');
    }
    public function completed(Task $task)
    {
        if (auth()->id() !== $task->user_id) {
            abort(403, "Ceci n'est pas votre tâche !");
        }
        $task->update([
            'completed' => true,
            'completed_at' => now()
        ]);
        if ($task->reminder) {
            $task->reminder->update(['active' => false]);
        }

        return redirect()->route('tasks.index')->with('success', "Tâche $task->title marquée comme terminée !");
    }
    public function show(Task $task)
    {
        if (auth()->id() !== $task->user_id) {
            abort(403, "Ceci n'est pas votre tâche !");
        }
        return view('tasks.show', compact('task'));
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('home');
    }
    
}
