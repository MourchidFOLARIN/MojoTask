<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon; 

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
{   // On force Carbon (les dates) à parler français
        Carbon::setLocale('fr');
        
        // Optionnel : On force aussi PHP pour certains formats spécifiques
        setlocale(LC_TIME, 'fr_FR.utf8');
        Paginator::useTailwind();
    // Force le HTTPS si l'application est en production sur Railway
    if (config('app.env') === 'production') {
        URL::forceScheme('https');
    }
}

    

  
}