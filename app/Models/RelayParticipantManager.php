<?php

namespace App\Models;

/**
 * App\Models\ParticipantManager
 *
 * @property-read \App\Models\Participant $participant
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Participant $uuidCard
 * @property-read \App\Models\Stage $stage
 * @mixin \Eloquent
 */
class RelayParticipantManager extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'relay_participant_id',
        'participant_name',
        'uuidcards_id',
        'created_at',
        'updated_at',
    ];

    public function participant()
    {
        return $this->belongsTo(RelayParticipant::class, 'id');
    }


    public function uuidcard()
    {
        return $this->belongsTo(UuidCard::class, 'uuidcards_id');
    }

    public function createArray($data)
    {
        $this->insert($data);
    }
}
