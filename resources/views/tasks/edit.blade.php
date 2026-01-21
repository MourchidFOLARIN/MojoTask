@extends('layouts.app')

@section('title', 'Modifier la tâche - MojoTask')

@section('content')
    <div class="min-h-screen bg-gray-50 py-12 px-4">
        <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-xl shadow-gray-200/50 overflow-hidden">

            {{-- Bandeau décoratif supérieur --}}

            <div class="p-8 md:p-12">
                {{-- Header --}}
                <div class="mb-10 flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-extrabold text-blue-500 tracking-tight">
                            Modifier la tâche
                        </h1>
                        <p class="text-gray-500 mt-2 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                            {{ $task->title }}
                        </p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div
                        class="mb-8 p-4 bg-green-50 text-green-700 rounded-2xl border border-green-100 flex items-center gap-3 animate-bounce-short">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Formulaire --}}
                <form class="space-y-8" method="POST" action="{{ route('tasks.update', $task) }}">
                    @csrf
                    @method('PUT')

                    {{-- Titre --}}
                    <div class="group">
                        <label
                            class="block font-bold text-gray-700 mb-2 group-focus-within:text-blue-600 transition-colors">
                            Titre de la tâche
                        </label>
                        <input type="text" name="title" value="{{ old('title', $task->title) }}"
                            placeholder="Ex: Acheter du pain..."
                            class="w-full px-5 py-4 rounded-2xl  bg-gray-50   focus:ring-blue-400 focus:bg-white focus:ring-4  focus:border-blue-500  outline-none transition-all @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="text-sm text-red-500 mt-2 flex items-center gap-1">
                                <span class="italic">⚠️</span> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div>
                        <label class="block font-bold text-gray-700 mb-2">Description <span
                                class="text-gray-400 font-normal">(optionnel)</span></label>
                        <textarea rows="4" name="description" placeholder="Détaillez votre mission..."
                            class="w-full px-5 py-4 rounded-2xl border-gray-200 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all">{{ old('description', $task->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Date & Heure --}}
                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Date et heure limite</label>
                            <input type="datetime-local" name="due_date"
                                value="{{ old('due_date', $task->due_date?->format('Y-m-d\TH:i')) }}"
                                class="w-full px-5 py-4 rounded-2xl border-gray-200 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all">
                            @error('due_date')
                                <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Priorité --}}
                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Niveau de priorité</label>
                            <select name="priority"
                                class="w-full px-5 py-4 rounded-2xl border-gray-200 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all">
                                <option value="low" @selected(old('priority', $task->priority) == 'low')>🟢 Basse</option>
                                <option value="medium" @selected(old('priority', $task->priority) == 'medium')>🟡 Moyenne</option>
                                <option value="high" @selected(old('priority', $task->priority) == 'high')>🔴 Haute</option>
                            </select>
                        </div>
                    </div>

                    {{-- Rappel --}}
                    {{-- Rappel --}}
                    <div
                        class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-3xl border border-blue-100 space-y-4">
                        <label class="flex items-start gap-4 cursor-pointer">
                            <input type="checkbox" name="reminder" id="reminder-checkbox" value="1"
                                @checked(old('reminder', $task->reminder ?? false))
                                class="w-6 h-6 mt-1 text-blue-600 border-gray-300 rounded-lg focus:ring-blue-500">
                            <div>
                                <p class="font-bold text-blue-900 text-lg">Activer les rappels</p>
                                <p class="text-sm text-blue-600/80 leading-relaxed">
                                    Recevez un message touchant si la tâche n’est pas terminée à temps.
                                </p>
                            </div>
                        </label>

                        {{-- Champ Numéro WhatsApp (Caché par défaut) --}}
                        <div id="whatsapp-field"
                            class="{{ old('reminder', $task->reminder ?? false) ? '' : 'hidden' }} animate-fade-in">
                            <label for="whatsapp_number" class="block text-sm font-bold text-blue-900 mb-2 ml-1">
                                Votre numéro WhatsApp ,si vous desirez recevoir les message également par whatsapp (format international)
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 font-medium">
                                    +
                                </span>
                                <input type="text" name="whatsapp_number" id="whatsapp_number"
                                    value="{{ old('whatsapp_number', $task->whatsapp_number ?? (auth()->user()->whatsapp_number ?? '')) }}"
                                    placeholder="33612345678"
                                    class="w-full pl-8 pr-5 py-3 bg-white border-blue-100 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-400 transition-all outline-none text-blue-900">
                            </div>
                            @error('whatsapp_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-blue-500 mt-2 italic">Exemple : 33 pour la France, 229 pour le Bénin,
                                etc.</p>
                        </div>
                    </div>

                    {{-- Boutons --}}
                    <div class="flex flex-col sm:flex-row justify-end gap-4 pt-8 border-t border-gray-100">
                        <a href="{{ route('tasks.index') }}"
                            class="px-8 py-4 rounded-2xl text-gray-500 font-bold hover:bg-gray-100 transition-colors text-center order-2 sm:order-1">
                            Annuler
                        </a>

                        <button type="submit"
                            class="px-10 py-4 rounded-2xl bg-blue-600 text-white font-bold hover:bg-blue-700 transition-all shadow-xl shadow-blue-200 hover:-translate-y-1 active:scale-95 order-1 sm:order-2">
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('include.footer')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('reminder-checkbox');
            const whatsappField = document.getElementById('whatsapp-field');

            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    whatsappField.classList.remove('hidden');
                    whatsappField.classList.add('block');
                } else {
                    whatsappField.classList.add('hidden');
                    whatsappField.classList.remove('block');
                }
            });
        });
    </script>
@endsection
