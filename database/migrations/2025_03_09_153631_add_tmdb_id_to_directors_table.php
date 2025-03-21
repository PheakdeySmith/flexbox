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
        Schema::table('directors', function (Blueprint $table) {
            $table->integer('tmdb_id')->nullable()->after('id');
            $table->date('birth_date')->nullable()->after('profile_photo');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('directors', function (Blueprint $table) {
            $table->dropColumn('tmdb_id');
            $table->dropColumn('birth_date');
            $table->dropSoftDeletes();
        });
    }
};
