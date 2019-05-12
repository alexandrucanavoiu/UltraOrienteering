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
        'id',
        'stage_name',
        'created_at',
        'updated_at',
    ];

    public function participantManagers()
    {
        return $this->hasMany(ParticipantManager::class);
    }
}
