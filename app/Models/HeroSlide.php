<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    protected $fillable = [
        'badge', 'title', 'subtitle',
        'btn1_text', 'btn1_url', 'btn2_text', 'btn2_url',
        'desktop_image', 'mobile_image',
        'order', 'active',
    ];

    protected $casts = ['active' => 'boolean'];

    public function scopeActive($q)   { return $q->where('active', true); }
    public function scopeOrdered($q)  { return $q->orderBy('order')->orderBy('id'); }

    public function desktopImageUrl(): string
    {
        return $this->desktop_image
            ? asset('storage/' . $this->desktop_image)
            : asset('assets/img/hero/hero-1.jpg');
    }

    public function mobileImageUrl(): string
    {
        return $this->mobile_image
            ? asset('storage/' . $this->mobile_image)
            : $this->desktopImageUrl();
    }
}
