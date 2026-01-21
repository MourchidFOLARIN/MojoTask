@extends('layouts.app')

@section('title', 'MojoTask - Accueil')

@section('content')

<div class="min-h-screen bg-gradient-to-r from-blue-200 to-blue-100 flex flex-col">

    {{-- Hero Section --}}
    <div class="flex-1 flex items-center justify-center p-6 h-screen">
        <div class="max-w-5xl grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            
            {{-- Texte --}}
            <div class="space-y-6">
                <h1 class="text-4xl md:text-5xl font-bold text-blue-700 leading-tight text-center md:text-left">
                    Organisez vos journées et ne ratez plus jamais vos tâches
                </h1>
                <p class="text-gray-700 text-lg">
                    <span class="text-orange-500 font-bold">MojoTask</span> vous aide à gérer vos tâches efficacement. Connectez-vous avec votre compte Google pour synchroniser vos tâches et recevoir des rappels par email si vous oubliez de compléter vos tâches.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 mt-4">
                    <a href="{{ route('tasks.index') }}"
                        class="bg-green-600 text-white px-6 py-3 rounded-full text-center font-semibold hover:bg-green-700 transition">
                        Voir mes tâches
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-green-600 text-white px-6 py-3 text-center rounded-full font-semibold hover:bg-green-700 transition">
                        créer un compte
                    </a>
                </div>
            </div>

            {{-- Image / illustration --}}
            <div class="flex justify-center">
                <img src="images/1000132945-removebg-preview.png" alt="Todo List Illustration" class=" w-80 h-80 md:w-120 md:h-120">
            </div>
        </div>
    </div>

    {{-- Features Section --}}
    <div class="bg-white py-16 px-6">
        <h2 class="text-3xl font-bold text-center text-blue-700 mb-10">Pourquoi utiliser MojoTask ?</h2>
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            
            <div class="p-6 border rounded-lg shadow hover:shadow-lg transition">
                <div class="text-2xl mb-3 flex justify-center items-center"><img src="images/checklist.svg" alt="" class="w-1/5 "></div>
                <h3 class="font-semibold text-lg mb-2 text-orange-500">Gérez vos tâches</h3>
                <p class="text-gray-600">Créez, modifiez et suivez vos tâches pour rester productif et organisé.</p>
            </div>

            <div class="p-6 border rounded-lg shadow hover:shadow-lg transition">
                <div class="text-2xl mb-3 flex justify-center items-center"><img src="images/mail (1).svg" alt="" class="w-1/5 "></div>
                <h3 class="font-semibold text-lg mb-2 text-orange-500">Rappel par email</h3>
                <p class="text-gray-600">Si vous oubliez une tâche, vous recevrez un rappel automatique par email et par whatsapp.</p>
            </div>

            <div class="p-6 border rounded-lg shadow hover:shadow-lg transition">
                <div class="text-2xl mb-3 flex justify-center items-center"><img src="images/ouvrir.png" alt="" class="w-1/5 "></div>
                <h3 class="font-semibold text-lg mb-2 text-orange-500">Connexion sécurisée</h3>
                <p class="text-gray-600">Connectez-vous avec Google pour sécuriser vos tâches et les synchroniser sur tous vos appareils.</p>
            </div>

        </div>
    </div>
        {{-- Storytelling Section --}}
    <div class="bg-white py-20 px-6">
        <h2 class="text-3xl md:text-4xl font-bold text-center text-blue-700 mb-4">
            Une simple Todo List peut tout changer
        </h2>
        <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">
            Chaque jour, des milliers de personnes échouent à accomplir leurs tâches…
            tandis que d’autres avancent sereinement grâce à une bonne organisation.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-6xl mx-auto">

            {{-- ÉCHEC --}}
            <div>
                <h3 class="text-2xl font-bold text-red-500 mb-4 text-center">
                     Sans <span class="text-orange-500 font-bold">MojoTask</span> 
                </h3>

                <div class="relative overflow-hidden rounded-xl shadow-lg">
                    <div id="bad-slider" class="flex transition-transform duration-700">
                        @php
                            $badImages = [
                                ['img' => 'images/7f31c149aa38bc5ff3b667fae5024107.jpg', 'text' => 'Trop de choses à faire, rien n’est fait'],
                                ['img' => 'images/26384594c00a7f4b3b194e0d523c595c.jpg', 'text' => 'Stress constant et manque de concentration'],
                            ];
                            shuffle($badImages);
                        @endphp

                        @foreach($badImages as $item)
                            <div class="min-w-full relative">
                                <img src="{{ $item['img'] }}" class="w-full h-64 object-cover">
                                <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                                    <p class="text-white text-lg font-semibold text-center px-4">
                                        {{ $item['text'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- RÉUSSITE --}}
            <div>
                <h3 class="text-2xl font-bold text-green-600 mb-4 text-center  ">
                   
                    Avec <span class="text-orange-500 font-bold">MojoTask</span> 
                </h3>

                <div class="relative overflow-hidden rounded-xl shadow-lg">
                    <div id="good-slider" class="flex transition-transform duration-700">
                        @php
                            $goodImages = [
                                ['img' => 'images/a61915ea604d2b3aaf052217a5f143d7.jpg', 'text' => 'Chaque tâche est claire et planifiée'],
                                ['img' => 'images/2f18598373ad54dbf5f7024aca9ecfd1.jpg', 'text' => 'Productivité et sérénité au quotidien'],
                                
                            ];
                            shuffle($goodImages);
                        @endphp

                        @foreach($goodImages as $item)
                            <div class="min-w-full relative">
                                <img src="{{ $item['img'] }}" class="w-full h-64 object-cover">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                                    <p class="text-white text-lg font-semibold text-center px-4">
                                        {{ $item['text'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- CTA Section --}}
    <div class="bg-blue-50 py-12 text-center">
        <h2 class="text-3xl font-bold text-blue-700 mb-4">Prêt à commencer ?</h2>
        <p class="text-gray-700 mb-6">Connectez-vous maintenant et organisez vos tâches de manière efficace.</p>
        <a href="{{ route('auth.google') }}"
           class="bg-red-500 text-white px-8 py-4 rounded-full font-bold hover:bg-red-600 transition inline-block">
           Se connecter avec Google
        </a>
    </div>

    {{-- Footer --}}
    <footer class="bg-blue-50 py-6 text-center text-gray-700">
        &copy; 2026  <span class="text-orange-500 font-bold">MojoTask</span> . Tous droits réservés. | <a href="#" class="text-blue-500">Politique de confidentialité</a>
    </footer>

</div>
<script>
    function autoSlide(id, count) {
        let index = 0;
        setInterval(() => {
            index = (index + 1) % count;
            document.getElementById(id).style.transform =
                `translateX(-${index * 100}%)`;
        }, 3500);
    }

    autoSlide('bad-slider', 5);
    autoSlide('good-slider', 5);
</script>

@endsection
