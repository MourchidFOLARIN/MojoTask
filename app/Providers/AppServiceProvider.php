<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon; // <--- N'oublie pas d'ajouter cet import

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
        
        // Optionnel : On force aussi PHP pour certains formats spécifiques
        setlocale(LC_TIME, 'fr_FR.utf8');
        Paginator::useTailwind();
    }

  
}