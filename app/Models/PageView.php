<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = [
        'url', 'page', 'ip', 'country', 'country_code',
        'continent', 'region', 'city', 'device', 'browser',
        'referrer', 'session_id',
    ];
}
