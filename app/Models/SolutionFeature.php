<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolutionFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'solution_id',
        'feature_title',
        'feature_icon'
    ];

    /**
     * Relationship to solution
     */
    public function solution()
    {
        return $this->belongsTo(Solution::class);
    }

    /**
     * Get icon class for Font Awesome
     */
    public function getIconClassAttribute()
    {
        return 'fas fa-' . ($this->feature_icon ?? 'check');
    }
}