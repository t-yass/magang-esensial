<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('workshop_intensifs', function (Blueprint $table) {
            $table->dropColumn(['title', 'subtitle', 'cta_text', 'cta_link']);
            $table->json('taglines')->nullable(); // Array of taglines like ["Pelayanan Prima", "Citra Positif", etc.]
        });
    }

    public function down(): void
    {
        Schema::table('workshop_intensifs', function (Blueprint $table) {
            $table->string('title')->default('Workshop Intensif');
            $table->string('subtitle')->default('SERVICE EXCELLENCE');
            $table->string('cta_text')->default('Daftar Sekarang');
            $table->string('cta_link')->default('#contact');
            $table->dropColumn('taglines');
        });
    }
};