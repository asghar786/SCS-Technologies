<?php

namespace App\Http\Controllers;

use App\Models\ContactInquiry;
use App\Models\Service;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $services = Service::active()->ordered()->get(['id', 'title']);
        return view('contact', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:30',
            'subject' => 'nullable|string|max:255',
            'service' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        ContactInquiry::create($validated);

        return redirect()->route('contact')->with('success', 'Thank you! Your message has been received. We will be in touch shortly.');
    }
}
