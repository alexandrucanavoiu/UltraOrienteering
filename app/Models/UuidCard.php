<?php

namespace App\Models;

/**
 * App\Models\UuidCard
 *
 * @property-read \App\Models\Participant $participant
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ParticipantManager[] $participantManagers
 * @mixin \Eloquent
 * @property int $id
 * @property string $uuidcard
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UuidCard whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UuidCard whereUuidcard($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UuidCard whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UuidCard whereUpdatedAt($value)
 */
class UuidCard extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'id',
        'uuidcard',
    ];

    public function participant()
    {
        return $this->hasOne(Participant::class);
    }

    public function participantManagers()
    {
        return $this->hasMany(ParticipantManager::class);
    }
}