<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkshopIntensif extends Model
{
    protected $fillable = ['description', 'taglines', 'is_visible'];

    protected $casts = [
        'is_visible' => 'boolean',
        'taglines' => 'array'
    ];

    public function photos(): HasMany
    {
        return $this->hasMany(WorkshopIntensifPhoto::class);
    }

    public function visiblePhotos()
    {
        return $this->photos()->where('is_visible', true)->orderBy('sort_order');
    }
}
