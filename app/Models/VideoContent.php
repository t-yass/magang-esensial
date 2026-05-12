<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoContent extends Model
{
    protected $fillable = [
        'section',
        'title',
        'url',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];
}
