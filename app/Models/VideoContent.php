<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoContent extends Model
{
    protected $fillable = [
        'section',
        'source_type',
        'title',
        'description',
        'url',
        'file_path',
        'sort_order',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function getVideoUrlAttribute(): ?string
    {
        if ($this->source_type === 'upload' && $this->file_path) {
            return asset('storage/' . $this->file_path);
        }

        return $this->url;
    }
}
