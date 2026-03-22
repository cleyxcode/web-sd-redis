<?php

namespace App\Providers\Filament;

use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()

            // ── Tema: warna brand sekolah ──
            ->colors([
                // Primary: Teal (#0B7B8B) — untuk tombol, navigasi aktif, aksen
                'primary' => [
                    50  => '240, 253, 252',
                    100 => '204, 251, 247',
                    200 => '153, 246, 236',
                    300 => '94, 234, 220',
                    400 => '45, 212, 199',
                    500 => '20, 184, 170',
                    600 => '11, 123, 139',   // #0B7B8B — warna utama sekolah
                    700 => '10, 100, 113',
                    800 => '10, 83, 94',
                    900 => '13, 35, 64',     // #0D2340 — navy sekolah
                    950 => '7, 20, 38',
                ],
                'danger'  => Color::Rose,
                'gray'    => Color::Slate,
                'info'    => Color::Sky,
                'success' => Color::Emerald,
                'warning' => Color::Amber,
            ])

            // ── Font: Poppins — modern & profesional ──
            ->font('Poppins')

            // ── Brand logo custom ──
            ->brandLogo(fn () => view('filament.admin.logo'))
            ->brandLogoHeight('2.75rem')

            // ── Dark mode: default ikut sistem ──
            ->defaultThemeMode(ThemeMode::Light)

            // ── Favicon dari settings (jika ada) ──
            ->favicon(function () {
                $logo = \App\Models\Setting::where('key', 'favicon')->value('value');
                return $logo ? asset('storage/' . $logo) : null;
            })

            // ── Custom theme CSS (hasil compile Tailwind v3) ──
            ->theme(asset('css/filament/admin/theme.css'))

            // ── Navigation grouping ──
            ->navigationGroups([
                'Konten Website',
                'Data Sekolah',
                'Pendaftaran (PPDB)',
                'Pengaturan',
            ])

            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
