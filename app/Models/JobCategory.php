<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    protected $fillable = [
        'name', 'slug', 'parent_id', 'icon', 'color', 'seo_title', 'seo_description', 'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function parent()
    {
        return $this->belongsTo(JobCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(JobCategory::class, 'parent_id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'category_id');
    }
}
