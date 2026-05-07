<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Run: php artisan make:migration add_subtitle_to_certifications_table
return new class extends Migration {
    public function up(): void
{
    Schema::create('certifications', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('subtitle')->nullable();
    $table->integer('sort_order')->default(0);   // ✅ urutan
    $table->boolean('is_visible')->default(true); // ✅ tampil/sembunyi
    $table->timestamps();
});
}

    public function down(): void
    {
        Schema::table('certifications', function (Blueprint $table) {
            $table->dropColumn('subtitle');
        });
    }
};