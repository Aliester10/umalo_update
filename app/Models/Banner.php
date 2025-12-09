<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 't_banner';

    protected $fillable = [
        'image_url',       // DESKTOP
        'image_mobile',    // MOBILE
        'title',
        'subtitle',
        'description',
        'button_text',
        'button_url',
    ];
}
