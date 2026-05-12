<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('video_contents', function (Blueprint $table) {
            if (Schema::hasColumn('video_contents', 'source_type')) {
                $table->dropColumn('source_type');
            }
            if (Schema::hasColumn('video_contents', 'file_path')) {
                $table->dropColumn('file_path');
            }
        });
    }

    public function down(): void
    {
        Schema::table('video_contents', function (Blueprint $table) {
            if (!Schema::hasColumn('video_contents', 'source_type')) {
                $table->enum('source_type', ['link', 'upload'])->default('link')->after('section');
            }
            if (!Schema::hasColumn('video_contents', 'file_path')) {
                $table->string('file_path')->nullable()->after('url');
            }
        });
    }
};
