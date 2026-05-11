<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            if (Schema::hasColumn('blog_posts', 'excerpt')) {
                $table->dropColumn('excerpt');
            }
            if (Schema::hasColumn('blog_posts', 'status')) {
                $table->dropColumn('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            if (! Schema::hasColumn('blog_posts', 'excerpt')) {
                $table->text('excerpt')->nullable()->after('category');
            }
            if (! Schema::hasColumn('blog_posts', 'status')) {
                $table->enum('status', ['draft', 'published'])->default('draft')->after('thumbnail_path');
            }
        });
    }
};
