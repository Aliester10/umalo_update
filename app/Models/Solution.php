<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'long_description',
        'cover_image',
        'thumbnail',
        'brochure_file',
        'order',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function features()
    {
        return $this->hasMany(SolutionFeature::class);
    }

    public function metrics()
    {
        return $this->hasMany(SolutionMetric::class);
    }

    public function tags()
    {
        return $this->hasMany(SolutionTag::class);
    }

    public function media()
    {
        return $this->hasMany(SolutionMedia::class);
    }
}
