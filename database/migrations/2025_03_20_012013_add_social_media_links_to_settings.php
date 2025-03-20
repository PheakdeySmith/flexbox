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
        Schema::table('settings', function (Blueprint $table) {
            // Check if columns don't exist before adding them
            if (!Schema::hasColumn('settings', 'twitter_link')) {
                $table->string('twitter_link')->nullable();
            }
            if (!Schema::hasColumn('settings', 'facebook_link')) {
                $table->string('facebook_link')->nullable();
            }
            if (!Schema::hasColumn('settings', 'instagram_link')) {
                $table->string('instagram_link')->nullable();
            }
            if (!Schema::hasColumn('settings', 'whatsapp_link')) {
                $table->string('whatsapp_link')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['twitter_link', 'facebook_link', 'instagram_link', 'whatsapp_link']);
        });
    }
};
