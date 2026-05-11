<?php

namespace App\Providers;

use App\Models\Setting;
use App\View\Composers\NavigationComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
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
