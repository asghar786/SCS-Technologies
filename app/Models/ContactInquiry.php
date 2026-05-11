<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInquiry extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'subject', 'service', 'message', 'read_at'];

    protected $casts = ['read_at' => 'datetime'];
}
