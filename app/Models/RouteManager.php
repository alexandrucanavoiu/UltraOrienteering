<?php

namespace App\Models;

/**
 * App\Models\Route
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @mixin \Eloquent
 */
class RouteManager extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'routes_managers';

    protected $fillable = [
        'id',
        'routes_id',
        'post_code',
        'created_at',
        'updated_at',
    ];

    public function routes()
    {
        return $this->belongsTo(Route::class, 'routes_id');
    }

    public function createArray($data)
    {
        $this->insert($data);
    }

}
