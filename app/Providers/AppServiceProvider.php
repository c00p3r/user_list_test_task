<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Setting faker localization
        $this->app->singleton(\Faker\Generator::class, function () {
            return \Faker\Factory::create('uk_UA');
        });

//        Handle model deleting
        User::deleting(function ($user) {
            $user->comments()->delete();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {

            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
//            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);

//            $aliasLoader = AliasLoader::getInstance();
//            $aliasLoader->alias('Debugbar', 'Barryvdh\Debugbar\Facade');
        }
    }
}
