<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerRoadmap extends Model
{
    protected $fillable = ['title', 'slug', 'steps', 'description'];

    protected $casts = [
        'steps' => 'array'
    ];
}
