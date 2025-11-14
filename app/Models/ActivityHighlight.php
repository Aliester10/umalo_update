<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityHighlight extends Model
{
    protected $fillable = ['activity_id', 'highlight'];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
