<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'employment_type',
        'tags',
        'description',
        'requirements',
        'is_active',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_active' => 'boolean',
    ];

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
