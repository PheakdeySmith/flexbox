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
        Schema::table('payments', function (Blueprint $table) {
            // Add payment_type column after payment_method
            $table->enum('payment_type', ['subscription', 'movie_purchase'])
                ->after('payment_method')
                ->default('subscription');

            // Make subscription_id nullable since we'll use polymorphic relationship
            $table->foreignId('subscription_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('payment_type');
        });
    }
};
