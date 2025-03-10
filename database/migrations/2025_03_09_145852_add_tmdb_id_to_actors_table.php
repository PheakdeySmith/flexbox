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
        Schema::table('actors', function (Blueprint $table) {
            $table->integer('tmdb_id')->nullable()->after('id');
            $table->string('character')->nullable()->after('profile_photo');
        });

        // Add character column to movie_actor pivot table
        Schema::table('movie_actor', function (Blueprint $table) {
            $table->string('character')->nullable()->after('actor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('actors', function (Blueprint $table) {
            $table->dropColumn('tmdb_id');
            $table->dropColumn('character');
        });

        Schema::table('movie_actor', function (Blueprint $table) {
            $table->dropColumn('character');
        });
    }
};
