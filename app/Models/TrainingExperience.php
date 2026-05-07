<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingExperience extends Model
{
    protected $fillable = ['category', 'stat_label', 'description', 'sort_order', 'is_visible'];

    protected $casts = ['is_visible' => 'boolean'];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }
}