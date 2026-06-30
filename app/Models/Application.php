<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'job_id', 'candidate_id', 'resume_path', 'cover_letter',
        'match_score', 'skill_score', 'location_score', 'experience_score',
        'salary_score', 'education_score', 'status', 'status_history'
    ];

    protected $casts = [
        'match_score' => 'integer',
        'skill_score' => 'integer',
        'location_score' => 'integer',
        'experience_score' => 'integer',
        'salary_score' => 'integer',
        'education_score' => 'integer',
        'status_history' => 'array'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function candidate()
    {
        return $this->belongsTo(User::class, 'candidate_id');
    }
}
