<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'biography', 'profile_photo'];

    public function movie()
    {
        return $this->hasMany(Movie::class, 'movie_director');
    }
}
