<?php

namespace App\Providers;


use App\Models\Recipe;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        
        Gate::define('view-recipe', function ($user = null){            // Definējam gate kam nav nepieciešams autentificēts lietotājs.
            return true;                                                // Vienmēr atgriež true, kas nozīmē, ka ikviens lietotājs (autentificēts vai nē) var skatīties receptes.
        });

        Gate::define('create-recipe', function ($user) {
            return in_array($user->role, ['registered', 'admin']);      //Pārbauda, ​​vai lietotāja loma ir reģistrēts vai administrators
        });                                                             //Ja lietotāja loma ir viena no šīm, gate atgriež patieso vērtību, ļaujot lietotājam izveidot recepti.

        Gate::define('delete-recipe', function ($user, Recipe $recipe) {
            return $user->role === 'admin' || $user->id === $recipe->user_id;       //Ļauj dzēst, ja lietotājs ir administrators vai īpašnieks (lietotāja ID atbilst receptes user_id)
        });

        Gate::define('edit-recipe', function ($user, Recipe $recipe) {
            return $user->role === 'admin' || $user->id === $recipe->user_id;       //Ļauj rediģēt, ja lietotājs administrators vai īpašnieks (lietotāja ID atbilst receptes user_id).
        });
    }
}
