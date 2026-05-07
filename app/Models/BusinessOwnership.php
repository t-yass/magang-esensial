<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessOwnership extends Model
{
    protected $fillable = ['role', 'entity_name', 'sort_order', 'is_visible'];

    protected $casts = ['is_visible' => 'boolean'];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeOwner($query)
    {
        return $query->where('role', 'owner');
    }

    public function scopeFounder($query)
    {
        return $query->where('role', 'founder');
    }
}