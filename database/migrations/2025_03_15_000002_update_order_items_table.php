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
        Schema::table('order_items', function (Blueprint $table) {
            // Add order_id column after id
            $table->foreignId('order_id')->after('id')->nullable()->constrained()->onDelete('cascade');

            // Make user_id nullable since it will be linked through order
            if (Schema::hasColumn('order_items', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropColumn('order_id');
        });
    }
};
