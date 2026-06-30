<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title', 'slug', 'content', 'category_id', 'tags', 'seo_title', 'seo_description',
        'view_count', 'status', 'is_featured'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'view_count' => 'integer'
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
}
