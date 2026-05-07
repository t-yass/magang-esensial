<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('business_ownerships', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['owner', 'founder'])->default('founder');
            $table->string('entity_name');        // nama bisnis/lembaga
            $table->integer('sort_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_ownerships');
    }
};