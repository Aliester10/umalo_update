<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityGallery extends Model
{
    protected $fillable = ['activity_id', 'image'];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}