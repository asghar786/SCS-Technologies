<?php

namespace App\Models;

use App\Models\Traits\HasActiveScope;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasActiveScope;

    protected $fillable = ['question', 'answer', 'category', 'order', 'active'];

    protected $casts = ['active' => 'boolean'];
}
