<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['title', 'content', 'type', 'target_roles', 'status'];

    protected $casts = [
        'status' => 'boolean'
    ];
}
