<?php

namespace App\Models;

/**
 * App\Models\Stage
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ParticipantManager[] $participantManagers
 * @mixin \Eloquent
 */
class Stage extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'start_time',
        'duration',
    ];

    public function participantManagers()
    {
        return $this->hasMany(ParticipantManager::class);
    }
}
