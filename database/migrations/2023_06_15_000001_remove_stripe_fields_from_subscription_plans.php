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
        Schema::table('subscription_plans', function (Blueprint $table) {
            // Check if the column exists before trying to drop it
            if (Schema::hasColumn('subscription_plans', 'stripe_price_id')) {
                $table->dropColumn('stripe_price_id');
            }

            if (Schema::hasColumn('subscription_plans', 'stripe_price')) {
                $table->dropColumn('stripe_price');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscription_plans', function (Blueprint $table) {
            // Add the columns back if they don't exist
            if (!Schema::hasColumn('subscription_plans', 'stripe_price_id')) {
                $table->string('stripe_price_id')->nullable();
            }

            if (!Schema::hasColumn('subscription_plans', 'stripe_price')) {
                $table->string('stripe_price')->nullable();
            }
        });
    }
};
