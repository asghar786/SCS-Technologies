<?php

namespace App\Models;

use App\Models\Traits\HasActiveScope;
use App\Models\Traits\HasSlugRouteKey;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasActiveScope, HasSlugRouteKey;

    protected $fillable = ['title', 'slug', 'icon', 'image', 'banner_image', 'short_desc', 'full_desc', 'order', 'active'];

    protected $casts = ['active' => 'boolean'];

    protected static function booted(): void
    {
        static::saved(fn () => cache()->forget('nav_services'));
        static::deleted(fn () => cache()->forget('nav_services'));
    }
}
