<?php

namespace App\Models;

/**
 * App\Models\Category
 *
 * @property-read \App\Models\Route $route
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ParticipantManager[] $participantManagers
 * @mixin \Eloquent
 */
class RelayCategoryManager extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'relay_categories_managers';

    protected $fillable = [
        'id',
        'relay_category_id',
        'routes_id',
        'created_at',
        'updated_at',
    ];

    public function category()
    {
        return $this->belongsTo(RelayCategory::class, 'relay_categories_id');
    }

    public function route()
    {
        return $this->belongsTo(Route::class, 'routes_id');
    }

    public function createArray($data)
    {
        $this->insert($data);
    }
}
