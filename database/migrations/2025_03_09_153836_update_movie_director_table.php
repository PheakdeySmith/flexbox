<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('movie_director')) {
            Schema::create('movie_director', function (Blueprint $table) {
                $table->id();
                $table->foreignId('movie_id')->constrained()->onDelete('cascade');
                $table->foreignId('director_id')->constrained()->onDelete('cascade');
                $table->string('job')->nullable(); // Director, Producer, etc.
                $table->timestamps();

                // Add a unique constraint to prevent duplicate entries
                $table->unique(['movie_id', 'director_id', 'job']);
            });
        } else {
            // Check if the unique constraint exists before trying to drop it
            $constraintExists = $this->constraintExists('movie_director', 'movie_director_movie_id_director_id_unique');

            Schema::table('movie_director', function (Blueprint $table) {
                if (!Schema::hasColumn('movie_director', 'job')) {
                    $table->string('job')->nullable()->after('director_id'); // Director, Producer, etc.
                }
            });

            // Handle constraints separately to avoid errors
            if ($constraintExists) {
                Schema::table('movie_director', function (Blueprint $table) {
                    $table->dropUnique(['movie_id', 'director_id']);
                });
            }

            // Check if the new constraint already exists
            $newConstraintExists = $this->constraintExists('movie_director', 'movie_director_movie_id_director_id_job_unique');

            if (!$newConstraintExists) {
                Schema::table('movie_director', function (Blueprint $table) {
                    $table->unique(['movie_id', 'director_id', 'job']);
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('movie_director')) {
            if (Schema::hasColumn('movie_director', 'job')) {
                // Check if the unique constraint exists before trying to drop it
                $constraintExists = $this->constraintExists('movie_director', 'movie_director_movie_id_director_id_job_unique');

                if ($constraintExists) {
                    Schema::table('movie_director', function (Blueprint $table) {
                        $table->dropUnique(['movie_id', 'director_id', 'job']);
                    });
                }

                Schema::table('movie_director', function (Blueprint $table) {
                    $table->dropColumn('job');
                });

                // Check if the old constraint already exists
                $oldConstraintExists = $this->constraintExists('movie_director', 'movie_director_movie_id_director_id_unique');

                if (!$oldConstraintExists) {
                    Schema::table('movie_director', function (Blueprint $table) {
                        $table->unique(['movie_id', 'director_id']);
                    });
                }
            }
        }
    }

    /**
     * Check if a constraint exists in the database
     */
    private function constraintExists($table, $constraintName): bool
    {
        $database = DB::connection()->getDatabaseName();

        $result = DB::select("
            SELECT COUNT(*) as count
            FROM information_schema.table_constraints
            WHERE constraint_name = '$constraintName'
            AND table_name = '$table'
            AND table_schema = '$database'
        ");

        return $result[0]->count > 0;
    }
};
