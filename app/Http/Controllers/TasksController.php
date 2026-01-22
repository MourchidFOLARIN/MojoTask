<?php

namespace App\Http\Controllers;

use App\Models\Task;
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
        $validated = $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'nullable|string',
            'due_date'        => 'required|date|after:now',
            'priority'        => 'required|in:low,medium,high',
            'whatsapp_number' => 'nullable|numeric|digits_between:8,15'
        ], [
            'title.required'    => 'Le titre est obligatoire.',
            'due_date.after'    => 'La date doit être dans le futur.',
            'whatsapp_number.numeric' => 'Le numéro WhatsApp ne doit contenir que des chiffres.',
        ]);

        $task = Task::create([
            'user_id'         => auth()->id(),
            'title'           => $validated['title'],
            'description'     => $request->description,
            'due_date'        => $validated['due_date'],
            'priority'        => $validated['priority'],
            'reminder'        => $request->has('reminder'),
            'whatsapp_number' => $request->whatsapp_number,
        ]);

        if ($request->has('reminder')) {
            TaskReminder::create([
                'task_id' => $task->id,
                'enabled' => true,
            ]);
        }

        return to_route('tasks.index')->with('success', 'Votre tâche a été ajoutée avec succès !');
    }

    public function edit(Task $task)
    {
        $this->authorizeUser($task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorizeUser($task);

        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
            'description' => 'nullable|string'
        ]);

        // Correction : On utilise les données validées pour la mise à jour
        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Mise à jour réussie');
    }

    public function destroy(Task $task)
    {
        $this->authorizeUser($task);
        $task->delete();
        return redirect()->back()->with('success', 'La tâche a été supprimée !');
    }

    public function completed(Task $task)
    {
        $this->authorizeUser($task);

        $task->update([
            'completed' => true,
            'completed_at' => now()
        ]);

        // Correction : Vérifier si la relation existe avant d'updater le rappel
        if ($task->taskReminder) { 
            $task->taskReminder->update(['enabled' => false]);
        }

        return redirect()->route('tasks.index')->with('success', "Tâche \"{$task->title}\" terminée !");
    }

    public function show(Task $task)
    {
        $this->authorizeUser($task);
        return view('tasks.show', compact('task'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('home');
    }
    private function authorizeUser(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403, "Action non autorisée.");
        }
    }
}