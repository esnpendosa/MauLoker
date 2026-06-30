<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdStatistic extends Model
{
    protected $fillable = ['ad_id', 'date', 'impressions', 'clicks'];

    protected $casts = [
        'date' => 'date',
        'impressions' => 'integer',
        'clicks' => 'integer'
    ];

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
