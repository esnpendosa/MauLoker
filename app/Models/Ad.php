<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'name', 'position_code', 'status', 'start_date', 'end_date',
        'target_device', 'target_page', 'target_category_id', 'target_city',
        'format_type', 'code_content', 'image_path', 'destination_url',
        'priority', 'max_impressions', 'max_clicks'
    ];

    protected $casts = [
        'status' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'priority' => 'integer',
        'max_impressions' => 'integer',
        'max_clicks' => 'integer'
    ];

    public function position()
    {
        return $this->belongsTo(AdPosition::class, 'position_code', 'code');
    }

    public function statistics()
    {
        return $this->hasMany(AdStatistic::class);
    }
}
