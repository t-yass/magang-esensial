<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Get a setting value by key, with optional default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $settings = Cache::remember('site_settings', 60, function () {
            return static::all()->pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }

    /**
     * Set (upsert) a setting value and clear cache.
     */
    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget('site_settings');
    }

    /**
     * Set multiple settings at once.
     */
    public static function setMany(array $data): void
    {
        foreach ($data as $key => $value) {
            static::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        Cache::forget('site_settings');
    }

    /**
     * Get all settings as a flat key-value array.
     */
    public static function all_settings(): array
    {
        return Cache::remember('site_settings', 60, function () {
            return static::all()->pluck('value', 'key')->toArray();
        });
    }

    public static function logoUrl(): string
    {
        $path = static::get('site_logo');
        return $path ? asset('storage/' . $path) : asset('images/logo.JPEG');
    }

    public static function faviconUrl(): string
    {
        return static::logoUrl();
    }
}