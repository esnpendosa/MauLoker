<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'company_id', 'category_id', 'title', 'slug', 'description', 'requirements',
        'skills', 'experience_years', 'education_level', 'employment_type',
        'location_type', 'city', 'salary_min', 'salary_max', 'salary_currency',
        'benefits', 'status', 'is_featured', 'is_sponsored', 'is_urgent',
        'views_count', 'applies_count'
    ];

    protected $casts = [
        'skills' => 'array',
        'experience_years' => 'integer',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_sponsored' => 'boolean',
        'is_urgent' => 'boolean',
        'views_count' => 'integer',
        'applies_count' => 'integer'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function category()
    {
        return $this->belongsTo(JobCategory::class, 'category_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
