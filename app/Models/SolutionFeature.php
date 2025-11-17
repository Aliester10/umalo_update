<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolutionFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'solution_id',
        'icon',
        'feature',
    ];

    public function solution()
    {
        return $this->belongsTo(Solution::class);
    }
}
