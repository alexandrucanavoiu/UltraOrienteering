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
        'id',
        'uuidcards_id',
        'clubs_id',
        'participant_name',
        'created_at',
        'updated_at',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class, 'clubs_id');
    }

    public function uuidcard()
    {
        return $this->belongsTo(UuidCard::class, 'uuidcards_id');
    }

}
