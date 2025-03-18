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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('StreamIT')->nullable();
            $table->string('site_title')->default('StreamIT');
            $table->text('copyright_text')->nullable();
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->string('apple_store_link')->nullable();
            $table->string('google_play_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
