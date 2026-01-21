@extends('layouts.app')

@section('title', 'Tableau de bord - Mes tâches')

@section('content')
    <div class="min-h-screen bg-gray-50/50 pb-12">
        {{-- Messages de succès --}}
        @if (session('success'))
            <div class="max-w-6xl mx-auto px-4 mt-6">
                <div
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative shadow-sm animate-bounce">
                    <span class="block sm:inline font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">

            {{-- Header Section --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-10">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Tableau de bord</h1>
                    <p class="text-gray-500 mt-1">Gérez vos priorités et suivez votre progression.</p>
                </div>
                <div class="flex flex-row justify-center items-center">
                    <a href="{{ route('tasks.create') }}"
                        class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-semibold rounded-xl text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all active:scale-95">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Nouvelle tâche
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-logout-2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                                <path d="M15 12h-12l3 -3" />
                                <path d="M6 15l-3 -3" />
                            </svg>
                        </button>
                    </form>

                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
                @php
                    $stats = [
                        ['Total', $taskSum, 'bg-blue-50', 'text-blue-600'],
                        ['Terminées', $taskCompleted, 'bg-green-50', 'text-green-600'],
                        ['En attente', $taskPending, 'bg-yellow-50', 'text-yellow-600'],
                        ['En retard', $taskOverdue, 'bg-red-50', 'text-red-600'],
                    ];
                @endphp
                @foreach ($stats as $stat)
                    <div
                        class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">{{ $stat[0] }}</p>
                        <p class="text-2xl font-bold mt-2 {{ $stat[3] }}">{{ $stat[1] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Tasks List --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                {{-- Version Desktop (Table) --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Tâche</th>
                                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Échéance</th>
                                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase text-center">Priorité
                                </th>
                                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase text-center">Statut</th>
                                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($tasks as $task)
                                <tr class="hover:bg-blue-50/30 transition-colors">
                                    <td class="px-6 py-4">
                                        <a href="{{ route('tasks.show', $task) }}"
                                            class="font-semibold text-gray-800 hover:text-blue-600 transition">
                                            {{ $task->title }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-700">
                                            {{ $task->due_date->translatedFormat('d M, H:i') }}</div>
                                        <div class="text-xs text-gray-400">{{ $task->due_date->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-3 py-1 text-xs font-bold rounded-full {{ $task->priority == 'high' ? 'bg-red-100 text-red-600' : ($task->priority == 'medium' ? 'bg-yellow-100 text-yellow-600' : 'bg-blue-100 text-blue-600') }}">
                                            {{ strtoupper($task->priority) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @include('tasks.partials.status-badge', ['task' => $task])
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end items-center gap-2">
                                            @include('tasks.partials.actions', ['task' => $task])
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                @include('tasks.partials.empty-state')
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Version Mobile (Cards) --}}
                <div class="md:hidden divide-y divide-gray-100">
                    @forelse ($tasks as $task)
                        <div class="p-5 hover:bg-gray-50 transition">
                            <div class="flex justify-between items-start mb-3">
                                <a href="{{ route('tasks.show', $task) }}"
                                    class="font-bold text-gray-900 text-lg">{{ $task->title }}</a>
                                @include('tasks.partials.status-badge', ['task' => $task])
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $task->due_date->translatedFormat('d M, H:i') }}
                            </div>
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-xs font-bold uppercase {{ $task->priority == 'high' ? 'text-red-600' : 'text-gray-400' }}">
                                    Priorité: {{ $task->priority }}
                                </span>
                                <div class="flex gap-2">
                                    @include('tasks.partials.actions', ['task' => $task])
                                </div>
                            </div>
                        </div>
                    @empty
                        @include('tasks.partials.empty-state')
                    @endforelse
                </div>
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
    @include('include.footer')
@endsection
