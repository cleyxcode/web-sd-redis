<?php

namespace App\Providers;

use App\Models\ProfilSekolah;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer(['layouts.app', 'layouts.auth'], function ($view) {
            $view->with('profil', ProfilSekolah::first());
            $view->with('settings', Setting::all()->pluck('value', 'key'));
        });
    }
}
