<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tmdb_id',
        'title',
        'description',
        'release_date',
        'poster_url',
        'backdrop_url',
        'duration',
        'price',
        'trailer_url',
        'imdb_rating',
        'country',
        'language',
        'type',
        'maturity_rating',
        'is_free',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'release_date' => 'date',
        'price' => 'decimal:2',
        'imdb_rating' => 'decimal:1',
        'is_free' => 'boolean',
    ];

    public function directors()
    {
        return $this->hasMany(Director::class, 'movie_director');
    }
}
