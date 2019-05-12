<?php

namespace App\Models;

class ParticipantStages extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'participants_id',
        'stages_id',
        'categories_id',
        'uuidcards_id',
        'start_time',
        'finish_time',
        'total_time',
        'abandon',
        'missed_posts',
        'order_posts',
        'created_at',
        'updated_at',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participants_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function uuidcard()
    {
        return $this->belongsTo(UuidCard::class, 'uuidcards_id');
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stages_id');
    }
}
