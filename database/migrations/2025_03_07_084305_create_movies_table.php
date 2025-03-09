<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tmdb_id')->unique()->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('release_date')->nullable();
            $table->string('poster_url')->nullable();
            $table->string('backdrop_url')->nullable();
            $table->integer('duration')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->string('trailer_url')->nullable();
            $table->decimal('imdb_rating', 3, 1)->nullable();
            $table->string('country')->nullable();
            $table->string('language')->nullable();
            $table->enum('type', ['movie', 'tv_series']);
            $table->enum('maturity_rating', ['G', 'PG', 'PG-13', 'R', 'NC-17'])->nullable();
            $table->boolean('is_free')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('movies');
    }
};
