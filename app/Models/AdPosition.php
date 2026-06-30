<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdPosition extends Model
{
    protected $fillable = ['code', 'name', 'description'];

    public function ads()
    {
        return $this->hasMany(Ad::class, 'position_code', 'code');
    }
}
