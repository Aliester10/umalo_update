<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMemberSocial extends Model
{
    protected $table = 'team_member_socials';

    protected $fillable = [
        'team_member_id',
        'linkedin',
        'instagram',
        'github',
        'youtube',
        'facebook',
    ];

    // Relasi: Social belongs to Team Member
    public function member()
    {
        return $this->belongsTo(TeamMember::class);
    }
}
