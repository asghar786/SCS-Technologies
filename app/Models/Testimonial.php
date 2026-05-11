<?php

namespace App\Models;

use App\Models\Traits\HasActiveScope;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasActiveScope;

    protected $fillable = ['client_name', 'company', 'position', 'quote', 'rating', 'photo', 'active'];

    protected $casts = ['active' => 'boolean'];
}
