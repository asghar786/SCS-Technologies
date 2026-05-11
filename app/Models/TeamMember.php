<?php

namespace App\Models;

use App\Models\Traits\HasActiveScope;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasActiveScope;

    protected $fillable = ['name', 'title', 'bio', 'photo', 'facebook', 'twitter', 'linkedin', 'order', 'active'];

    protected $casts = ['active' => 'boolean'];
}
