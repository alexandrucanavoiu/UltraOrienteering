<?php

namespace App\Models;

/**
 * App\Models\Category
 *
 * @property-read \App\Models\Route $route
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ParticipantManager[] $participantManagers
 * @mixin \Eloquent
 */
class RelayCategory extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'category_name',
        'created_at',
        'updated_at',
    ];

    public function createArray($data)
    {
        $this->insert($data);
    }

    public function CategoryManager()
    {
        return $this->hasMany(RelayCategoryManager::class);
    }

    public function CategoryStagesParticipant()
    {
        return $this->hasMany(RelayParticipantStage::class, 'relay_categories_id');
    }
}
