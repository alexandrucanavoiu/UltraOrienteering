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
class RelayParticipantStage extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'relay_participant_id',
        'relay_participant_managers_id',
        'uuidcards_id',
        'stages_id',
        'relay_categories_id',
        'relay_category_managers_id',
        'routes_id',
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
        return $this->belongsTo(RelayParticipant::class, 'relay_participant_id');
    }

    public function participants()
    {
        return $this->hasMany(RelayParticipantManager::class, 'relay_participant_id');
    }

    public function participant_stage()
    {
        return $this->belongsTo(RelayParticipantManager::class, 'relay_participant_managers_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(RelayCategory::class, 'relay_categories_id');
    }

    public function CategoryManager()
    {
        return $this->belongsTo(RelayCategoryManager::class, 'relay_category_managers_id');
    }

    public function uuidcard()
    {
        return $this->belongsTo(UuidCard::class, 'uuidcards_id');
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stages_id');
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
