<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'name', 'is_active', 'primary_color', 'primary_hover', 'primary_dark',
        'light_bg', 'light_card', 'dark_bg', 'dark_card', 'text_light', 'text_dark',
        'border_radius', 'font_family', 'button_style', 'card_style'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
