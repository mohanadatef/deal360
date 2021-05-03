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
        $setting=Setting::first();
        view()->composer(['*'], function ($view) use ($setting){
            $view->with('setting', $setting);
        });
    }
}
