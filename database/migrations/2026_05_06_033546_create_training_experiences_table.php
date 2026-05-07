<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('training_experiences', function (Blueprint $table) {
            $table->id();
            $table->string('category');           // e.g. "Instansi Korporasi"
            $table->string('stat_label');         // e.g. "35+"
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_experiences');
    }
};