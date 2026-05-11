<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $fillable = [
        'title', 'slug', 'category', 'event_date', 'content',
        'thumbnail_path', 'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'event_date'   => 'date',
    ];

    protected static function booted()
    {
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = static::generateUniqueSlug($post->title);
            }
        });

        static::updating(function ($post) {
            if ($post->isDirty('title')) {
                $post->slug = static::generateUniqueSlug($post->title, $post->id);
            }
        });
    }

    private static function generateUniqueSlug(string $title, int $exceptId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)
            ->when($exceptId, fn($query) => $query->where('id', '!=', $exceptId))
            ->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')->latest('published_at');
    }

    public function getExcerptAttribute(): string
    {
        if (! empty($this->attributes['excerpt'] ?? null)) {
            return strip_tags($this->attributes['excerpt']);
        }

        return Str::limit(strip_tags($this->content ?? ''), 150);
    }

    public function getThumbnailUrlAttribute(): string
    {
        return $this->thumbnail_path ? asset('storage/' . $this->thumbnail_path) : '';
    }

    public function getDisplayDateAttribute(): ?string
    {
        if ($this->event_date) {
            return $this->event_date->format('d M Y');
        }

        return $this->published_at ? $this->published_at->format('d M Y') : null;
    }
}
