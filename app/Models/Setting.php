<?php

namespace App\Models;

class Setting extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'organizer_name',
        'competition_type',
        'created_at',
        'updated_at'
    ];
}
