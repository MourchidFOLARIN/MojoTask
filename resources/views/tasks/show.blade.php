@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-xl border border-gray-100">

        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-3xl font-bold text-blue-500">{{ $task->title }}</h1>
                <p class="text-sm text-gray-500 mt-1">Créée le {{ $task->created_at->translatedFormat('d F Y à H:i') }}</p>
            </div>
            @php
                switch ($task->priority) {
                    case 'high':
                        $priority = 'Haute';
                        break;
                    case 'medium':
                        $priority = 'Moyenne';
                        break;
                    default:
                        $priority = 'Base';
                }
            @endphp
            <span
                class="px-4 py-1 text-sm font-semibold rounded-full 
            {{ $priority == 'Haute' ? 'bg-red-100 text-red-600' : ($priority == 'Moyenne' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700') }}">
                Priorité {{ $priority }}
            </span>
        </div>

        <hr class="border-gray-100 mb-6">

        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Description</h2>
            <div class="p-4 bg-gray-50 rounded-lg text-gray-600 leading-relaxed">
                {{ $task->description ?: 'Aucune description fournie.' }}
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="flex items-center space-x-3 p-4 border border-gray-100 rounded-lg">
                <div class="p-2 bg-blue-50 text-blue-600 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase font-bold">Échéance</p>
                    <p class="text-gray-700 font-medium">
                        {{ $task->due_date ? $task->due_date->translatedFormat('d F Y • H:i') : 'Non définie' }}
                    </p>
                </div>
            </div>

            <div class="flex items-center space-x-3 p-4 border border-gray-100 rounded-lg">
                @if ($task->due_date < now())
                    <div class="p-2 bg-red-50 text-red-500 ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                @else
                    <div
                        class="p-2 {{ $task->completed_at ? 'bg-green-50 text-green-600' : 'bg-orange-50 text-orange-600' }} rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                @endif

                <div>
                    <p class="text-xs text-gray-400 uppercase font-bold">Statut actuel</p>
                    @if ($task->due_date < now() && !$task->completed_at)
                        <p class="font-medium text-red-500">
                            En retard
                        </p>
                    @else
                        <p class="font-medium {{ $task->completed_at ? 'text-green-600' : 'text-orange-600' }}">
                            {{ $task->completed_at ? 'Terminée le ' . $task->completed_at->translatedFormat('d/m à H:i') : 'En cours de réalisation' }}
                        </p>
                    @endif

                </div>
            </div>
        </div>

        <div class="flex flex-wrap gap-4 pt-6 border-t border-gray-100">
            @if (!$task->completed_at)
                <form action="{{ route('tasks.completed', $task) }}" method="POST">
                    @csrf @method('PUT')
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition font-medium">
                        Marquer comme terminée
                    </button>
                </form>
            @endif
            
                <a href="{{ route('tasks.edit', $task) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition font-medium">
                    Modifier la tâche
                </a>

                <a href="{{ route('tasks.index') }}"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-6 py-2 rounded-lg transition font-medium">
                    Retour à la liste
                </a>
  
        </div>
    </div>
@endsection
