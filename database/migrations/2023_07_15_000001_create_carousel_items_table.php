<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carousel_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('link_url');
            $table->enum('content_type', ['image', 'video']);
            $table->string('image_url')->nullable();
            $table->string('video_url')->nullable();
            $table->string('poster_url')->nullable()->comment('Thumbnail for video content');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carousel_items');
    }
};
