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
        return $this->belongsTo(Participant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function uuidcard()
    {
        return $this->belongsTo(UuidCard::class, 'uuid_card_id');
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
