<div class="flex items-center gap-2">
    {{-- Bouton Terminer --}}
    @if(!$task->completed)
    <form action="{{ route('tasks.completed', $task) }}" method="POST" class="inline">
        @csrf
        @method('PUT')
        <button type="submit" 
                class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors" 
                title="Marquer comme terminée"
                onclick="return confirm('Bravo ! Tu as fini cette tâche ?')">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </button>
    </form>
    @endif

    {{-- Bouton Modifier --}}
    <a href="{{ route('tasks.edit', $task) }}" 
       class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" 
       title="Modifier la tâche">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
        </svg>
    </a>

    {{-- Bouton Supprimer --}}
    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" 
                title="Supprimer la tâche"
                onclick="return confirm('Es-tu sûr de vouloir supprimer cette tâche ?')">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </button>
    </form>
</div>