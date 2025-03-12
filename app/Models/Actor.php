<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'actors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'biography',
        'profile_photo',
        'birth_date',
        'tmdb_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * Get the movies that feature this actor.
     */
    public function movies()
{
    return $this->belongsToMany(Movie::class, 'movie_actor')
                ->withPivot('character');
}
}
