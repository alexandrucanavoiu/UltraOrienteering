<?php

namespace App\Models;

/**
 * App\Models\ClubDistrict
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Club[] $clubs
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ClubDistrict whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ClubDistrict whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ClubDistrict whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ClubDistrict whereUpdatedAt($value)
 */
class ClubDistrict extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function clubs()
    {
        return $this->hasMany(Club::class);
    }
}
