<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('video_contents', function (Blueprint $table) {
            $table->id();
            $table->enum('section', ['training', 'testimonial'])->default('testimonial');
            $table->enum('source_type', ['link', 'upload'])->default('link');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->string('file_path')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_contents');
    }
};
