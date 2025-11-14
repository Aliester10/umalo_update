<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivitySchedule extends Model
{
    protected $fillable = ['activity_id', 'day_title', 'schedule_content'];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
