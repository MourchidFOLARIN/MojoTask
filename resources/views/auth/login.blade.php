@extends('layouts.auth')

@section('title', 'Connexion - Task Manager')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-gray-100 px-4">
    <div class="w-full max-w-md bg-white shadow-2xl rounded-[2.5rem] p-8 md:p-10 border border-white/50">

        {{-- Logo ou Titre --}}
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-blue-500 tracking-tight">
                Bon retour !
            </h2>
            <p class="text-gray-500 mt-2">Connectez-vous à <span class="text-orange-500 font-bold">Task Manager</span></p>
        </div>
        
        {{-- Message d’erreur global --}}
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 text-red-600 text-sm rounded-2xl border border-red-100 flex items-center gap-2 animate-shake">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Formulaire de connexion --}}
        <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-bold text-gray-700 mb-1 ml-1">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="votre@email.com"
                    value="{{ old('email') }}"
                    required
                    class="w-full px-5 py-4 bg-gray-50 border-gray-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all outline-none"
                >
                @error('email')
                    <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Mot de passe --}}
            <div>
                <label for="password" class="block text-sm font-bold text-gray-700 mb-1 ml-1">
                    Mot de passe
                </label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="••••••••"
                    required
                    class="w-full px-5 py-4 bg-gray-50 border-gray-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all outline-none"
                >
                @error('password')
                    <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Se souvenir de moi & Oubli --}}
            <div class="flex items-center justify-between px-1">
                <label class="flex items-center text-sm text-gray-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mr-2">
                    Se souvenir de moi
                </label>

                <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-700">
                    Oublié ?
                </a>
            </div>

            {{-- Bouton connexion --}}
            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-4 rounded-2xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 hover:-translate-y-0.5 transition-all active:scale-95"
            >
                Se connecter
            </button>
        </form>

        {{-- Séparateur --}}
        <div class="my-8 flex items-center before:flex-1 before:border-t before:border-gray-200 before:mr-4 after:flex-1 after:border-t after:border-gray-200 after:ml-4 text-gray-400 text-sm">
            OU
        </div>

        {{-- Connexion Google --}}
        <a
            href="{{ route('auth.google') }}"
            class="w-full flex items-center justify-center gap-3 border-2 border-gray-100 py-4 rounded-2xl font-bold text-gray-700 hover:bg-gray-50 transition-all active:scale-95"
        >
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google">
            Continuer avec Google
        </a>
         
        {{-- Pied de page : Inscription --}}
        <div class="mt-8 space-y-4 text-center">
            <p class="text-sm text-gray-600">
                Pas encore de compte ?
                <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">
                    S’inscrire gratuitement
                </a>
            </p>

            <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 text-gray-400 hover:text-gray-600 transition-colors text-sm font-medium group">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Retour à l'accueil
            </a>
        </div>
    </div>
</div>
@endsection