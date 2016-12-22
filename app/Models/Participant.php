<?php

namespace App\Models;

/**
 * App\Models\Participant
 *
 * @property-read \App\Models\Club $club
 * @property-read \App\Models\UuidCard $uuidcard
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ParticipantManager[] $participantManagers
 * @mixin \Eloquent
 */
class Participant extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'club_id',
        'uuid_card_id',
        'name',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function uuidcard()
    {
        return $this->belongsTo(UuidCard::class);
    }

    public function participantManagers()
    {
        return $this->hasMany(ParticipantManager::class);
    }
}
