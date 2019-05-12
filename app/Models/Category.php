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
        'id',
        'routes_id',
        'category_name',
        'created_at',
        'updated_at',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class, 'routes_id');
    }



}
