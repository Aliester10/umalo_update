<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;

class ActivityGallery extends Model
{
    protected $table = 'activity_galleries'; // SESUAIKAN
    public $timestamps = false;

    protected $fillable = ['activity_id', 'image'];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
