<?php

namespace App\Providers\Filament;

use App\Services\AlertBoxService;
use Cmsmaxinc\FilamentErrorPages\FilamentErrorPagesPlugin;
use DiogoGPinto\AuthUIEnhancer\AuthUIEnhancerPlugin;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Hardikkhorasiya09\ChangePassword\ChangePasswordPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
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

            // ── Custom theme CSS ──
            ->theme(asset('css/filament/admin/theme.css'))

            // ── Navigation grouping ──
            ->navigationGroups([
                'Konten Website',
                'Data Sekolah',
                'Pendaftaran (PPDB)',
                'Pengaturan',
            ])

            ->plugins([
                AuthUIEnhancerPlugin::make()
                    ->formPanelPosition('right')
                    ->formPanelWidth('40%')
                    ->showEmptyPanelOnMobile(false)
                    ->emptyPanelBackgroundColor(\Filament\Support\Colors\Color::Amber, '600')
                    ->emptyPanelBackgroundImageUrl('https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Kepulauan_Aru.jpg/1280px-Kepulauan_Aru.jpg')
                    ->emptyPanelBackgroundImageOpacity('40%'),
                ChangePasswordPlugin::make(),
                FilamentErrorPagesPlugin::make()
                    ->routes(['admin/*'])
                    ->onlyShowForConfiguredRoutes(),
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
            ->renderHook(
                PanelsRenderHook::PAGE_START,
                fn (): string => $this->renderAlertIfExists(
                    AlertBoxService::pendingPendaftaran()
                ),
            )
            ->renderHook(
                PanelsRenderHook::PAGE_HEADER_WIDGETS_AFTER,
                fn (): string => $this->renderAlertIfExists(
                    AlertBoxService::pendaftaranAktif()
                    ?? AlertBoxService::pendaftaranTutup()
                ),
            )
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

    private function renderAlertIfExists(?array $alert): string
    {
        if ($alert === null) return '';

        return Blade::render(
            view('filament.components.alert-box', $alert)->render()
        );
    }
}
