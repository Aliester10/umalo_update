<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolutionTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'solution_id',
        'tag',
    ];

    public function solution()
    {
        return $this->belongsTo(Solution::class);
    }
}
