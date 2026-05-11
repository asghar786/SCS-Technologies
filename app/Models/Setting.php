<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get(string $key, mixed $default = null): mixed
    {
        $all = cache()->remember('site_settings', 3600, fn () => static::pluck('value', 'key')->toArray());
        return $all[$key] ?? $default;
    }

    protected static function booted(): void
    {
        static::saved(fn () => cache()->forget('site_settings'));
        static::deleted(fn () => cache()->forget('site_settings'));
    }
}
