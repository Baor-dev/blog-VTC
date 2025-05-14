<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            if (!Schema::hasColumn('posts', 'content')) {
                $table->text('content')->nullable(); // Only add if missing
            }
            if (!Schema::hasColumn('posts', 'short_description')) {
                $table->string('short_description', 255)->nullable();
            }
            if (!Schema::hasColumn('posts', 'banner_image')) {
                $table->string('banner_image')->nullable();
            }
            if (!Schema::hasColumn('posts', 'gallery_images')) {
                $table->json('gallery_images')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['short_description', 'content', 'banner_image', 'gallery_images']);
        });
    }
};
