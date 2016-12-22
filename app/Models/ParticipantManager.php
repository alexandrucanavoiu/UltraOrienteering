<?php

namespace App\Models;

/**
 * App\Models\ParticipantManager
 *
 * @property-read \App\Models\Participant $participant
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Participant $uuidCard
 * @property-read \App\Models\Stage $stage
 * @mixin \Eloquent
 */
class ParticipantManager extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'participant_id',
        'category_id',
        'uuid_card_id',
        'stage_id',
        'post_start',
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
        'post_finish',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function uuidCard()
    {
        return $this->belongsTo(Participant::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
