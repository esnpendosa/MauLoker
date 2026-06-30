<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'user_id', 'name', 'slug', 'logo', 'banner', 'category', 'description',
        'website', 'email', 'phone', 'location', 'address', 'scale', 'verified',
        'reputation_score', 'response_time', 'top_employer', 'premium', 'status'
    ];

    protected $casts = [
        'verified' => 'boolean',
        'top_employer' => 'boolean',
        'premium' => 'boolean',
        'reputation_score' => 'double'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function badges()
    {
        return $this->hasMany(CompanyBadge::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
