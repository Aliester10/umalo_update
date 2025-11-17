<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolutionMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'solution_id',
        'type',
        'url',
    ];

    public function solution()
    {
        return $this->belongsTo(Solution::class);
    }
}
