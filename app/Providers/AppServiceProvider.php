<?php

namespace App\Providers;

use App\Models\Berita;
use App\Models\Pendaftaran;
use App\Models\ProfilSekolah;
use App\Models\Setting;
use App\Observers\BeritaObserver;
use App\Observers\PendaftaranObserver;
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
        Berita::observe(BeritaObserver::class);
        Pendaftaran::observe(PendaftaranObserver::class);

        View::composer(['layouts.app', 'layouts.auth'], function ($view) {
            $view->with('profil', ProfilSekolah::first());
            $view->with('settings', Setting::all()->pluck('value', 'key'));
        });
    }
}
