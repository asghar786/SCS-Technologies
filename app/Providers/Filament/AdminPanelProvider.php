<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
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
            ->colors([
                'primary' => Color::hex('#5A95CF'),
            ])
            ->brandLogoHeight('2.5rem')
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): HtmlString => new HtmlString('<style>
                    /* ── Background (login + full authenticated layout) ─────────── */
                    .fi-simple-layout,
                    .fi-layout {
                        background-image: url("' . asset('assets/img/infobg.jpg') . '") !important;
                        background-size: cover !important;
                        background-position: center !important;
                        background-repeat: no-repeat !important;
                        background-attachment: fixed !important;
                    }

                    /* ── Login page card ─────────────────────────────────────────── */
                    .fi-simple-main-ctn { backdrop-filter: blur(3px); }
                    .fi-simple-main {
                        background: rgba(255,255,255,0.82) !important;
                        backdrop-filter: blur(14px) !important;
                        box-shadow: 0 8px 40px rgba(0,0,0,0.28) !important;
                        border: 1px solid rgba(255,255,255,0.35) !important;
                    }

                    /* ── Glassmorphism sidebar ───────────────────────────────────── */
                    .fi-sidebar {
                        background: rgba(10, 20, 40, 0.55) !important;
                        backdrop-filter: blur(18px) saturate(160%) !important;
                        border-right: 1px solid rgba(255,255,255,0.1) !important;
                    }
                    /* Sidebar header (logo area) */
                    .fi-sidebar-header {
                        background: rgba(10, 20, 40, 0.3) !important;
                        border-bottom: 1px solid rgba(255,255,255,0.08) !important;
                        padding: 1.25rem 1rem !important;
                    }
                    /* Brand name text (fallback when no logo loaded) */
                    .fi-logo {
                        color: #fff !important;
                        filter: brightness(0) invert(1);
                    }
                    /* Nav group labels */
                    .fi-sidebar-group-label,
                    .fi-nav-group-label {
                        color: rgba(255,255,255,0.45) !important;
                        font-size: 0.65rem !important;
                        letter-spacing: 0.12em !important;
                        text-transform: uppercase !important;
                        padding-left: 0.75rem !important;
                    }
                    /* Nav items */
                    .fi-nav-item a,
                    .fi-sidebar-item a {
                        color: rgba(255,255,255,0.8) !important;
                        border-radius: 0.5rem !important;
                        transition: background 0.18s, color 0.18s !important;
                    }
                    .fi-nav-item a:hover,
                    .fi-sidebar-item a:hover {
                        background: rgba(255,255,255,0.1) !important;
                        color: #fff !important;
                    }
                    /* Active nav item */
                    .fi-nav-item-active a,
                    .fi-sidebar-item-active a {
                        background: rgba(90,149,207,0.45) !important;
                        color: #fff !important;
                        box-shadow: 0 2px 12px rgba(90,149,207,0.35) !important;
                    }
                    /* Icons */
                    .fi-nav-item a svg,
                    .fi-sidebar-item a svg {
                        color: rgba(255,255,255,0.7) !important;
                    }
                    .fi-nav-item-active a svg,
                    .fi-sidebar-item-active a svg {
                        color: #fff !important;
                    }
                    /* Sidebar collapse button */
                    .fi-sidebar-close-overlay-btn,
                    .fi-topbar-open-sidebar-btn { color: #fff !important; }

                    /* ── Main content area — subtle overlay so text stays readable ─ */
                    .fi-main {
                        background: rgba(243,244,246,0.88) !important;
                        backdrop-filter: blur(6px) !important;
                    }
                    /* Topbar */
                    .fi-topbar {
                        background: rgba(255,255,255,0.75) !important;
                        backdrop-filter: blur(12px) !important;
                        border-bottom: 1px solid rgba(0,0,0,0.06) !important;
                    }
                </style>')
            )
            ->brandName('SCS Technologies')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
