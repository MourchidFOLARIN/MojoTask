@php
    $dueDate = \Carbon\Carbon::parse($task->due_date);
    $daysLate = $dueDate->diffInDays(now());
    $hour = now()->hour;
    $hour = now('Africa/Porto-Novo')->hour;
    $greeting = $hour >= 5 && $hour < 18 ? 'Bonjour' : 'Bonsoir';

    // Les 21 messages classés par intensité
    $lvl1 = [
        "Chaque grand voyage commence par un petit pas. Ta tâche t'attend.",
        "Le succès, c'est de faire aujourd'hui ce que les autres remettent à demain.",
        "Ta future version te remerciera d'avoir fini cette tâche aujourd'hui.",
        "N'oublie pas pourquoi tu as commencé. Ton projet mérite cet effort.",
        'Une tâche terminée est un poids en moins sur tes épaules.',
        'Tu as le talent pour le faire, il ne te manque plus que le premier pas.',
        'La discipline est le pont entre tes objectifs et tes accomplissements.',
    ];
    $lvl2 = [
        "Le temps est la seule ressource que l'on ne peut pas racheter.",
        'Ta procrastination est le seul obstacle entre toi et tes rêves.',
        'Une tâche en suspens est une promesse non tenue envers toi-même.',
        "Le confort est l'ennemi de la croissance. Sors de ta zone, termine ceci.",
        'Imagine la satisfaction que tu ressentiras une fois que ce sera fini.',
        "Ne regarde pas l'heure, regarde le chemin qu'il te reste à conquérir.",
        'Plus tu attends, plus cette tâche semble lourde. Allège ton esprit.',
    ];
    $lvl3 = [
        'Est-ce que tu abandonnes tes ambitions pour quelques minutes de repos ?',
        "Le regret pèse des tonnes, l'effort ne pèse que quelques grammes.",
        'Chaque heure perdue est une opportunité volée à ton propre avenir.',
        'Tu vaux bien mieux que ce silence. Reprends le contrôle.',
        "Tes rêves ne s'accompliront pas seuls. Ils ont besoin d'action.",
        'Le monde attend que tu termines ce que tu as commencé.',
        'Affronte cette tâche une dernière fois, et montre-lui qui est le patron.',
    ];

    if ($daysLate <= 2) {
        $phrases = $lvl1;
        $color = '#3490dc';
    } elseif ($daysLate <= 5) {
        $phrases = $lvl2;
        $color = '#f39c12';
    } else {
        $phrases = $lvl3;
        $color = '#e3342f';
    }

    $phraseTouchante = $phrases[array_rand($phrases)];
@endphp

<div
    style="font-family: sans-serif; max-width: 600px; margin: auto; padding: 20px; border-top: 8px solid {{ $color }};">
    <p style="font-size: 18px;">{{ $greeting }} {{ $task->user->name }},</p>
    <div style="margin: 30px 0; font-style: italic; font-size: 22px; color: {{ $color }}; text-align: center;">
        "{{ $phraseTouchante }}"
    </div>
    <div style="background: #f4f4f4; padding: 15px; border-radius: 5px;">
        <strong>Tâche :</strong> {{ $task->title }} <br>
        <strong>Retard :</strong> {{ $task->due_date->diffForHumans() }}
    </div>
    <p style="text-align: center; margin-top: 25px;">
        <a href="{{ route('tasks.show', $task->id) }}"
            style="background: {{ $color }}; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px;">Je
            m'en occupe maintenant</a>
    </p>
</div>
