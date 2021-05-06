<?php

namespace App\Providers;

use App\Models\Setting\Setting;
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
        $language = language();
        $languageActive = languageActive();
        view()->composer(['*'], function ($view) use ($language,$languageActive){
            $view->with('language', $language);
            $view->with('languageActive', $languageActive);
        });
    }
}
