<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{

    protected $table = 'order_items';
    protected $fillable = ['movie_id', 'price'];

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }


}
