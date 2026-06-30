<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoPage extends Model
{
    protected $fillable = [
        'path_pattern', 'meta_title', 'meta_description', 'og_image', 'canonical',
        'schema_type', 'schema_data'
    ];

    protected $casts = [
        'schema_data' => 'array'
    ];
}
