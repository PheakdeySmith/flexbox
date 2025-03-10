<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'tmdb_id',
    ];

    /**
     * Get the movies associated with this genre.
     */
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_genre')
                    ->withTimestamps();
    }
}
