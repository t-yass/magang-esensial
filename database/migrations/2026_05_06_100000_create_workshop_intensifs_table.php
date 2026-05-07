<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('workshop_intensifs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Workshop Intensif');
            $table->string('subtitle')->default('SERVICE EXCELLENCE');
            $table->text('description')->nullable();
            $table->string('cta_text')->default('Daftar Sekarang');
            $table->string('cta_link')->default('#contact');
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });

        Schema::create('workshop_intensif_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workshop_intensif_id')->constrained('workshop_intensifs')->onDelete('cascade');
            $table->string('file_path');
            $table->string('alt_text')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workshop_intensif_photos');
        Schema::dropIfExists('workshop_intensifs');
    }
};
