<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'movie_id',
        'rating',
        'comment',
        'contains_spoilers',
        'is_approved',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'rating' => 'integer',
        'contains_spoilers' => 'boolean',
        'is_approved' => 'boolean',
    ];

    /**
     * Get the user that wrote the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the movie that was reviewed.
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    /**
     * Scope a query to only include approved reviews.
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * Scope a query to only include reviews without spoilers.
     */
    public function scopeWithoutSpoilers($query)
    {
        return $query->where('contains_spoilers', false);
    }
}
