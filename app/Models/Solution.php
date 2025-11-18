<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Solution extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'banner_image',
        'short_description',
        'overview_title',
        'overview_description',
        'benefits',
        'brochure_file',
        'contact_link',
        'order',
        'status'
    ];

    /**
     * Boot method for auto slug generation
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($solution) {
            if (empty($solution->slug)) {
                $solution->slug = Str::slug($solution->title);
            }
        });
    }

    /**
     * Relationship to features
     */
    public function features()
    {
        return $this->hasMany(SolutionFeature::class)->orderBy('id', 'asc');
    }

    /**
     * Scope for published/active solutions
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published'); // atau 'active' tergantung pilihan Anda
    }

    /**
     * Scope for ordered solutions
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    /**
     * Check if solution is published
     */
    public function isPublished()
    {
        return $this->status === 'published'; // atau 'active'
    }

    /**
     * Get banner image URL
     */
    public function getBannerImageUrlAttribute()
    {
        if ($this->banner_image && file_exists(public_path($this->banner_image))) {
            return asset($this->banner_image);
        }
        return 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=1400&h=1050&fit=crop&q=90';
    }

    /**
     * Check if brochure is available
     */
    public function hasBrochure()
    {
        return !empty($this->brochure_file) && file_exists(public_path($this->brochure_file));
    }
} 