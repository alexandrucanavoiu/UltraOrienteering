<?php

namespace App\Models;

/**
 * App\Models\Club
 *
 * @property-read \App\Models\ClubDistrict $clubDistrict
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Participant[] $participants
 * @mixin \Eloquent
 * @property int $id
 * @property int $club_district_id
 * @property string $name
 * @property string $city
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Club whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Club whereClubDistrictId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Club whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Club whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Club whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Club whereUpdatedAt($value)
 */
class Club extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'club_name',
        'city',
        'created_at',
        'updated_at'
    ];

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
