<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CvTemplate extends Model
{
    protected $fillable = ['name', 'slug', 'thumbnail', 'layout_blade', 'is_ats_friendly', 'status'];

    protected $casts = [
        'is_ats_friendly' => 'boolean',
        'status' => 'boolean'
    ];
}
