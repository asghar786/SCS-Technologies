<?php

namespace App\Models;

use App\Models\Traits\HasSlugRouteKey;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasSlugRouteKey;

    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'featured_image', 'category', 'author', 'author_image', 'published_at'];

    protected $casts = ['published_at' => 'datetime'];

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', now());
    }
}
