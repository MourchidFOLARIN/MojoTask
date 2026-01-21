<div class="p-12 text-center">
    <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-50 text-blue-600 rounded-full mb-6">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
        </svg>
    </div>
    <h3 class="text-xl font-bold text-gray-900 mb-2">Aucune tâche pour le moment</h3>
    <p class="text-gray-500 max-w-xs mx-auto mb-8">
        Organisez votre journée en ajoutant votre première mission dès maintenant.
    </p>
    <a href="{{ route('tasks.create') }}" 
       class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-blue-600 hover:bg-blue-700 transition shadow-lg shadow-blue-200">
        + Créer ma première tâche
    </a>
</div>