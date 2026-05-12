<?php

namespace App\Providers;

use App\Models\Setting;
use App\View\Composers\NavigationComposer;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Filament::serving(function (): void {
            $logo = Setting::where('key', 'logo')->value('value');
            if ($logo) {
                filament()->getCurrentPanel()->brandLogo(Storage::disk('public')->url($logo));
            }
        });

        View::composer('layouts.app', NavigationComposer::class);

        View::composer('*', function (\Illuminate\View\View $view): void {
            $sitePhone = Setting::get('phone', '+1 (305) 906-5182');
            $view->with([
                'sitePhone'    => $sitePhone,
                'sitePhoneTel' => 'tel:' . preg_replace('/[^\d+]/', '', $sitePhone),
                'siteEmail'    => Setting::get('email', 'syeds@scs-technologies.com'),
                'siteAddress'  => Setting::get('address_miami', '10125 NW 116th Way, Medley, Florida 33178'),
            ]);
        });
    }
}
