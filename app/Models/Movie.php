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
        return $this->belongsToMany(Director::class, 'movie_director')
                    ->withPivot('job')
                    ->withTimestamps();
    }

    /**
     * Get the actors that feature in this movie.
     */
    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'movie_actor');
    }

    /**
     * Get the genres associated with this movie.
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'movie_genre')
                    ->withTimestamps();
    }

    /**
     * Get the watchlist entries for this movie.
     */
    public function watchlistEntries()
    {
        return $this->hasMany(Watchlist::class);
    }

    /**
     * Get the reviews for this movie.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the average rating for this movie.
     */
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->approved()->avg('rating') ?: 0;
    }

    /**
     * Get the review count for this movie.
     */
    public function getReviewCountAttribute()
    {
        return $this->reviews()->approved()->count();
    }

    /**
     * Scope a query to only include active movies.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include free movies.
     */
    public function scopeFree($query)
    {
        return $query->where('is_free', true);
    }

    /**
     * Scope a query to only include movies (not TV series).
     */
    public function scopeMoviesOnly($query)
    {
        return $query->where('type', 'movie');
    }

    /**
     * Scope a query to only include TV series.
     */
    public function scopeTvSeries($query)
    {
        return $query->where('type', 'tv_series');
    }
}
