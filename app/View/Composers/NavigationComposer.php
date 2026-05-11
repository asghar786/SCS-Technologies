<?php

namespace App\View\Composers;

use App\Models\Service;
use Illuminate\View\View;

class NavigationComposer
{
    public function compose(View $view): void
    {
        $view->with('navServices', cache()->remember('nav_services', 3600,
            fn () => Service::active()->ordered()->get(['title', 'slug'])
        ));
    }
}
