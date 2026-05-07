<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkshopIntensifPhoto extends Model
{
    protected $fillable = ['workshop_intensif_id', 'file_path', 'alt_text', 'sort_order', 'is_visible'];

    protected $casts = ['is_visible' => 'boolean'];

    public function workshopIntensif()
    {
        return $this->belongsTo(WorkshopIntensif::class);
    }

    public function getFileUrlAttribute(): string
    {
        return asset('storage/' . $this->file_path);
    }
}
