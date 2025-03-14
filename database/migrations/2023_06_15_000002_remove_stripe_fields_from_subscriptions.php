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
        Schema::table('subscriptions', function (Blueprint $table) {
            // Check if the columns exist before trying to drop them
            if (Schema::hasColumn('subscriptions', 'stripe_id')) {
                $table->dropColumn('stripe_id');
            }

            if (Schema::hasColumn('subscriptions', 'stripe_status')) {
                $table->dropColumn('stripe_status');
            }

            if (Schema::hasColumn('subscriptions', 'stripe_price')) {
                $table->dropColumn('stripe_price');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            // Add the columns back if they don't exist
            if (!Schema::hasColumn('subscriptions', 'stripe_id')) {
                $table->string('stripe_id')->nullable();
            }

            if (!Schema::hasColumn('subscriptions', 'stripe_status')) {
                $table->string('stripe_status')->nullable();
            }

            if (!Schema::hasColumn('subscriptions', 'stripe_price')) {
                $table->string('stripe_price')->nullable();
            }
        });
    }
};
