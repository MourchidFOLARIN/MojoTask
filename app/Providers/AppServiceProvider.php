<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator; // Corrigé ici (pas de 'n')
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
     
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // On force Carbon (les dates) à parler français
        Carbon::setLocale('fr');
        
        // On force le nettoyage du cache à chaque démarrage
        Artisan::call('config:clear');

        // On force PHP pour certains formats spécifiques
        setlocale(LC_TIME, 'fr_FR.utf8');
        
        // Utilisation de Tailwind pour la pagination
        Paginator::useTailwind();

        // Force le HTTPS si l'application est en production sur Railway
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}