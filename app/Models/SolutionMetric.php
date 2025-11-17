<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolutionMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'solution_id',
        'label',
        'value',
    ];

    public function solution()
    {
        return $this->belongsTo(Solution::class);
    }
}
