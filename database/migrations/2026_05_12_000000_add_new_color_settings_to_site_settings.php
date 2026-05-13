<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\SiteSetting;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add default colors for new settings if they don't exist
        $defaults = [
            'navbar_color'          => '#04599A',     // Primary color
            'footer_color'          => '#072d52',     // Background color
            'section_accent_color'  => '#0ea5e9',     // Accent color
        ];

        foreach ($defaults as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        SiteSetting::whereIn('key', [
            'navbar_color',
            'footer_color',
            'section_accent_color',
        ])->delete();
    }
};
