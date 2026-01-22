@extends('layouts.app')

@section('title', 'Task Manager - Accueil')

@section('content')

    <div class="min-h-screen bg-gradient-to-r from-blue-200 to-blue-100 flex flex-col">

        {{-- Hero Section --}}
        <div class="flex-1 flex items-center justify-center p-6 min-h-screen">
            <div class="max-w-5xl grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

                {{-- Texte --}}
                <div class="space-y-6">
                    <h1 class="text-4xl md:text-5xl font-bold text-blue-700 leading-tight text-center md:text-left">
                        Organisez vos journées et ne ratez plus jamais vos tâches
                    </h1>
                    <p class="text-gray-700 text-lg">
                        <span class="text-orange-500 font-bold">Task Manager</span> vous aide à gérer vos tâches efficacement.
                        Connectez-vous avec Google pour synchroniser vos rappels par email et WhatsApp.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 mt-4">
                        <a href="{{ route('tasks.index') }}"
                            class="bg-green-600 text-white px-6 py-3 rounded-full text-center font-semibold hover:bg-green-700 transition">
                            Voir mes tâches
                        </a>
                        <a href="{{ route('register') }}"
                            class="bg-blue-600 text-white px-6 py-3 text-center rounded-full font-semibold hover:bg-blue-700 transition">
                            Créer un compte
                        </a>
                    </div>
                </div>

                {{-- Image / illustration --}}
                <div class="flex justify-center">
                    <img src="images/1000132945-removebg-preview.png" alt="Illustration Liste de tâches"
                        class="w-80 h-80 md:w-120 md:h-120 object-contain">
                </div>
            </div>
        </div>

        {{-- Features Section --}}
        <div class="bg-white py-16 px-6">
            <h2 class="text-3xl font-bold text-center text-blue-700 mb-10">Pourquoi utiliser Task Manager ?</h2>
            <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 text-center">

                <div class="p-6 border rounded-lg shadow hover:shadow-lg transition bg-gray-50">
                    <div class="text-2xl mb-3 flex justify-center items-center"><img src="images/checklist.svg"
                            alt="Gestion" class="w-16"></div>
                    <h3 class="font-semibold text-lg mb-2 text-orange-500">Gérez vos tâches</h3>
                    <p class="text-gray-600">Créez, modifiez et suivez vos tâches pour rester productif au quotidien.</p>
                </div>

                <div class="p-6 border rounded-lg shadow hover:shadow-lg transition bg-gray-50">
                    <div class="text-2xl mb-3 flex justify-center items-center"><img src="images/mail (1).svg"
                            alt="Rappels" class="w-16"></div>
                    <h3 class="font-semibold text-lg mb-2 text-orange-500">Rappels intelligents</h3>
                    <p class="text-gray-600">Recevez des alertes automatiques par email et WhatsApp pour ne rien oublier.
                    </p>
                </div>

                <div class="p-6 border rounded-lg shadow hover:shadow-lg transition bg-gray-50">
                    <div class="text-2xl mb-3 flex justify-center items-center"><img src="images/ouvrir.png" alt="Sécurité"
                            class="w-16"></div>
                    <h3 class="font-semibold text-lg mb-2 text-orange-500">Connexion sécurisée</h3>
                    <p class="text-gray-600">Synchronisez vos données en toute sécurité grâce à l'authentification Google.
                    </p>
                </div>

            </div>
        </div>

        {{-- Storytelling Section --}}
        <div class="bg-white py-20 px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-blue-700 mb-4">
                Un simple gestionnaire peut tout changer
            </h2>
            <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">
                Chaque jour, des milliers de personnes se laissent déborder…
                tandis que d’autres avancent sereinement grâce à une organisation claire.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-6xl mx-auto">

                {{-- ÉCHEC --}}
                <div class="rounded-xl overflow-hidden shadow-lg">
                    <h3 class="text-2xl font-bold text-red-500 mb-4 text-center">Sans Task Manager</h3>
                    <div class="relative h-64">
                        <img src="images/26384594c00a7f4b3b194e0d523c595c.jpg" class="w-full h-full object-cover"
                            alt="Chaos">
                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                            <p class="text-white text-lg font-semibold text-center px-4">
                                Trop de choses à faire, rien n’est terminé
                            </p>
                        </div>
                    </div>
                </div>

                {{-- RÉUSSITE --}}
                <div class="rounded-xl overflow-hidden shadow-lg">
                    <h3 class="text-2xl font-bold text-green-600 mb-4 text-center">Avec Task Manager</h3>
                    <div class="relative h-64">
                        <img src="images/a61915ea604d2b3aaf052217a5f143d7.jpg" class="w-full h-full object-cover"
                            alt="Succès">
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                            <p class="text-white text-lg font-semibold text-center px-4">
                                Productivité et sérénité retrouvées
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CTA Section --}}
        <div class="bg-blue-50 py-16 text-center">
            <h2 class="text-3xl font-bold text-blue-700 mb-4">Prêt à transformer votre quotidien ?</h2>
            <p class="text-gray-700 mb-8 max-w-md mx-auto">Rejoignez Task Manager dès aujourd'hui et reprenez le contrôle sur
                votre temps.</p>
            <a href="{{ route('auth.google') }}"
                class="bg-red-500 text-white px-8 py-4 rounded-full font-bold hover:bg-red-600 transition shadow-md inline-block">
                Se connecter avec Google
            </a>
        </div>

        {{-- Footer --}}
        <footer class="bg-white py-8 text-center text-gray-500 border-t">
            <p>&copy; 2026 <span class="text-orange-500 font-bold">Task Manager</span>. Tous droits réservés.</p>
            <div class="mt-2 space-x-4">
                <a href="#" class="hover:text-blue-500">Politique de confidentialité</a>
                <a href="#" class="hover:text-blue-500">Conditions d'utilisation</a>
            </div>
        </footer>

    </div>

@endsection
