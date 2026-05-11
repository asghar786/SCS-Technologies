<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;

class TeamController extends Controller
{
    public function index()
    {
        $members = TeamMember::active()->ordered()->get();
        return view('team', compact('members'));
    }
}
