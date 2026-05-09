<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('certifications', function (Blueprint $table) {
            if (Schema::hasColumn('certifications', 'subtitle')) {
                $table->dropColumn('subtitle');
            }
        });
    }

    public function down(): void
    {
        Schema::table('certifications', function (Blueprint $table) {
            if (!Schema::hasColumn('certifications', 'subtitle')) {
                $table->string('subtitle')->nullable()->after('title');
            }
        });
    }
};
