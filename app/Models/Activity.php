<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Activity extends Model
{
    use HasFactory;

    protected $table = 't_activities';

    protected $fillable = [
        'images', 'date', 'title', 'description', 'slug',
        'start_date', 'end_date', 'location', 'participants',
        'duration', 'category', 'status', 'cover_image', 'tags'
    ];

    protected $casts = [
        'date' => 'datetime',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Auto generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($activity) {
            if (!$activity->slug) {
                $activity->slug = Str::slug($activity->title);
            }
        });

        static::updating(function ($activity) {
            if (!$activity->slug) {
                $activity->slug = Str::slug($activity->title);
            }
        });
    }

    // Relationships
    public function galleries()
    {
        return $this->hasMany(ActivityGallery::class);
    }

    public function highlights()
    {
        return $this->hasMany(ActivityHighlight::class);
    }

    public function schedules()
    {
        return $this->hasMany(ActivitySchedule::class);
    }
}