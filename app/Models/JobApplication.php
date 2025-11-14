<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $table = 'job_applications';

    protected $fillable = [
        'job_position_id',
        'full_name',
        'email',
        'phone',
        'location',
        'linkedin',
        'resume',           // Sesuai dengan actual column di table
        'cover_letter',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship: Job Application belongs to Job Position
     */
    public function position()
    {
        return $this->belongsTo(JobPosition::class, 'job_position_id');
    }

    /**
     * Scope: Get pending applications
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope: Get reviewed applications
     */
    public function scopeReviewed($query)
    {
        return $query->where('status', 'reviewed');
    }

    /**
     * Scope: Get accepted applications
     */
    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    /**
     * Scope: Get rejected applications
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}