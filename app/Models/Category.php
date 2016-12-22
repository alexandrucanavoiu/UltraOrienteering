<?php

namespace App\Models;

/**
 * App\Models\Category
 *
 * @property-read \App\Models\Route $route
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ParticipantManager[] $participantManagers
 * @mixin \Eloquent
 */
class Category extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'route_id',
        'name',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function participantManagers()
    {
        return $this->hasMany(ParticipantManager::class);
    }
}
