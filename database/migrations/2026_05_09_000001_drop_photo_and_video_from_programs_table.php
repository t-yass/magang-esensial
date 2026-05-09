<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            if (Schema::hasColumn('programs', 'photo_path')) {
                $table->dropColumn('photo_path');
            }
            if (Schema::hasColumn('programs', 'video_path')) {
                $table->dropColumn('video_path');
            }
        });
    }

    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            if (!Schema::hasColumn('programs', 'photo_path')) {
                $table->string('photo_path')->nullable()->after('description');
            }
            if (!Schema::hasColumn('programs', 'video_path')) {
                $table->string('video_path')->nullable()->after('photo_path');
            }
        });
    }
};
