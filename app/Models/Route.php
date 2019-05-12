<?php

namespace App\Models;

/**
 * App\Models\Route
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @mixin \Eloquent
 */
class Route extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'route_name',
        'created_at',
        'updated_at',
    ];

}
