<?php

namespace App\Models\Traits;

trait HasSlugRouteKey
{
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
