<?php

namespace App\Http\Controllers;

use App\Models\Setting;

class PageController extends Controller
{
    public function privacyPolicy()
    {
        return view('pages.privacy-policy', [
            'content' => Setting::where('key', 'privacy_policy')->value('value') ?? '',
        ]);
    }

    public function termsConditions()
    {
        return view('pages.terms-conditions', [
            'content' => Setting::where('key', 'terms_conditions')->value('value') ?? '',
        ]);
    }

    public function disclaimer()
    {
        return view('pages.disclaimer', [
            'content' => Setting::where('key', 'disclaimer')->value('value') ?? '',
        ]);
    }
}
