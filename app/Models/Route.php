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
        'name',
        'length_in_km',
        'post_amount',
        'post_1',
        'post_2',
        'post_3',
        'post_4',
        'post_5',
        'post_6',
        'post_7',
        'post_8',
        'post_9',
        'post_10',
        'post_11',
        'post_12',
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
