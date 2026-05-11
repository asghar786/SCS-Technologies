<?php

namespace App\Http\Controllers;

use App\Mail\CallbackRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CallbackController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'callback_name'  => 'required|string|max:100',
            'callback_phone' => 'required|string|max:30',
        ]);

        Mail::to('info@scs-technologies.com')->send(new CallbackRequest($validated));

        return response()->json(['success' => true, 'message' => 'Thank you! We will call you shortly.']);
    }
}
