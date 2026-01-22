@extends('layouts.app')

@section('title', 'Nouvelle tâche - Task Manager')

@section('content')
    <div class="min-h-screen bg-gray-50 py-12 px-4">
        <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-xl shadow-gray-200/50 overflow-hidden">

            {{-- Bandeau décoratif (Vert pour la création) --}}


            <div class="p-8 md:p-12">
                {{-- Header --}}
                <div class="mb-10 flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-extrabold text-blue-500 tracking-tight">
                            Nouvelle tâche
                        </h1>
                        <p class="text-gray-500 mt-2">
                            Planifiez vos objectifs et restez productif.
                        </p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Alertes de succès --}}
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
                <form class="space-y-8" method="POST" action="{{ route('tasks.store') }}">
                    @csrf

                    {{-- Titre --}}
                    <div class="group">
                        <label
                            class="block font-bold text-gray-700 mb-2 group-focus-within:text-blue-600 transition-colors">
                            Titre de la tâche
                        </label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            placeholder="Ex: Préparer le projet ..."
                            class="w-full px-5 py-4 rounded-2xl border-gray-200 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-400 focus:border-blue-500 outline-none transition-all @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="text-sm text-red-500 mt-2 flex items-center gap-1 italic">⚠️ {{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div>
                        <label class="block font-bold text-gray-700 mb-2">Description <span
                                class="text-gray-400 font-normal">(optionnel)</span></label>
                        <textarea rows="4" name="description" placeholder="Ajoutez des détails sur cette tâche..."
                            class="w-full px-5 py-4 rounded-2xl border-gray-200 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-400 focus:border-blue-500  outline-none transition-all">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Date & Heure --}}
                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Date et heure limite</label>
                            <input type="datetime-local" name="due_date" min="{{ now()->format('Y-m-d\TH:i') }}"
                                value="{{ old('due_date') }}"
                                class="w-full px-5 py-4 rounded-2xl border-gray-200 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-400 outline-none focus:border-blue-500 transition-all">
                            @error('due_date')
                                <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Priorité --}}
                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Priorité</label>
                            <select name="priority"
                                class="w-full px-5 py-4 rounded-2xl border-gray-200 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-400 outline-none focus:border-blue-500 transition-all">
                                <option value="low" @selected(old('priority') == 'low')>🟢 Basse</option>
                                <option value="medium" @selected(old('priority', 'medium') == 'medium')>🟡 Moyenne</option>
                                <option value="high" @selected(old('priority') == 'high')>🔴 Haute</option>
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
                                <input type="tel" name="whatsapp_number" id="whatsapp_number"
                                    value="{{ old('whatsapp_number') }}"
                                    placeholder="33612345678"
                                    class="w-full pl-8 pr-5 py-3 bg-white border-blue-100 rounded-xl focus:ring-4 focus:ring-blue-200 focus:border-blue-400 transition-all outline-none text-blue-900">
                            </div>
                            @error('whatsapp_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-blue-500 mt-2 italic">Exemple : 33 pour la France, 229 pour le Bénin veillez ne pas ajoutez 01 au debut pour le Bénin,
                                etc.</p>
                        </div>
                    </div>

                    {{-- Boutons d'action --}}
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-8 border-t border-gray-100">
                        <a href="{{ route('tasks.index') }}"
                            class="text-gray-500 font-bold hover:text-gray-700 transition-colors flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Retour à la liste
                        </a>

                        <div class="flex gap-4 w-full sm:w-auto">
                            <button type="reset"
                                class="flex-1 px-6 py-4 rounded-2xl text-gray-500 font-bold hover:bg-gray-100 transition-all">
                                Effacer
                            </button>
                            <button type="submit"
                                class="flex-1 px-1 md:px-10 rounded-2xl bg-blue-600 text-white font-bold hover:bg-blue-700 transition-all shadow-xl shadow-blue-200 hover:-translate-y-1">
                                Créer la tâche
                            </button>
                        </div>
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
