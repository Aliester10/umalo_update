<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $table = 'team_members';

    protected $fillable = [
        'name',
        'position',
        'photo',
        'description',
        'order',
    ];

    // Relasi: One Member Has One Social Media
    public function socials()
    {
        return $this->hasOne(TeamMemberSocial::class);
    }
}
