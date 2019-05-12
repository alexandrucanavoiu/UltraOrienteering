<?php

namespace App\Models;

/**
 * App\Models\UuidCard
 */
class UuidCard extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'uuidcards';
    public $fillable = [
        'id',
        'uuid_name',
    ];

//    public function participant()
//    {
//        return $this->hasOne(Participant::class);
//    }
//
//    public function participantManagers()
//    {
//        return $this->hasMany(ParticipantManager::class);
//    }
}