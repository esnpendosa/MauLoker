<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analytics extends Model
{
    protected $fillable = ['event_name', 'event_data', 'ip_address', 'user_agent'];

    protected $casts = [
        'event_data' => 'array'
    ];
}
