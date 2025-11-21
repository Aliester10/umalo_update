<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessStep extends Model
{
    protected $table = 'process_steps';

    protected $fillable = [
        'step_number',
        'title',
        'description',
        'image',
    ];
}
