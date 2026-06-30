<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['title', 'subtitle', 'image_path', 'link_url', 'target', 'position', 'status'];

    protected $casts = [
        'status' => 'boolean'
    ];
}
