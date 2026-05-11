<?php

namespace App\Models;

use App\Models\Traits\HasSlugRouteKey;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasSlugRouteKey;

    protected $fillable = ['title', 'slug', 'category', 'client', 'description', 'thumbnail', 'images', 'featured', 'order'];

    protected $casts = ['images' => 'array', 'featured' => 'boolean'];
}
