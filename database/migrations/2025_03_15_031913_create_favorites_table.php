<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Reference to users table
            $table->foreignId('movie_id')->constrained()->onDelete('cascade'); // Reference to movies table
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};

