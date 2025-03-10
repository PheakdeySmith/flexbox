<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'movie_id',
        'added_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'added_at' => 'datetime',
    ];

    /**
     * Get the user that owns the watchlist item.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the movie that is in the watchlist.
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
