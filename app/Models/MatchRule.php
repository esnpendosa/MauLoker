<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchRule extends Model
{
    protected $fillable = [
        'skill_weight', 'location_weight', 'salary_weight', 'education_weight',
        'experience_weight', 'certification_weight', 'is_active'
    ];

    protected $casts = [
        'skill_weight' => 'integer',
        'location_weight' => 'integer',
        'salary_weight' => 'integer',
        'education_weight' => 'integer',
        'experience_weight' => 'integer',
        'certification_weight' => 'integer',
        'is_active' => 'boolean'
    ];
}
