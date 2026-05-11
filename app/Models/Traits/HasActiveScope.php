<?php

namespace App\Models\Traits;

trait HasActiveScope
{
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
