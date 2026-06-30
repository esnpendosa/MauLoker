<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryInsight extends Model
{
    protected $fillable = [
        'job_title', 'city', 'salary_min', 'salary_max', 'salary_avg', 'benchmark_data'
    ];

    protected $casts = [
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
        'salary_avg' => 'decimal:2',
        'benchmark_data' => 'array'
    ];
}
