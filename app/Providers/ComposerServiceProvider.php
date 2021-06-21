<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $nameDay = nameDay();
        $language = language();
        $languageActive = languageActive();
        view()->composer(['*'], function ($view) use ($language,$languageActive,$nameDay){
            $view->with('language', $language);
            $view->with('languageActive', $languageActive);
            $view->with('nameDay', $nameDay);
        });
    }
}
