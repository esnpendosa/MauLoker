<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyBadge extends Model
{
    protected $fillable = ['company_id', 'badge_name', 'badge_type', 'icon', 'color'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
