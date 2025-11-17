<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;

class ActivitySchedule extends Model
{
    protected $table = 'activity_schedules'; // SESUAIKAN
    public $timestamps = false;

    protected $fillable = ['activity_id', 'day_title', 'schedule_content'];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
