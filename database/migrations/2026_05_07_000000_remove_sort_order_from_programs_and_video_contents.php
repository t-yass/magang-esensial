<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasColumn('programs', 'sort_order')) {
            Schema::table('programs', function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }

        if (Schema::hasColumn('video_contents', 'sort_order')) {
            Schema::table('video_contents', function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }
    }

    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->integer('sort_order')->default(0)->after('description');
        });

        Schema::table('video_contents', function (Blueprint $table) {
            $table->integer('sort_order')->default(0)->after('file_path');
        });
    }
};
