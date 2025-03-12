<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'movie_id',
        'user_id',
        'price',
        'status',
    ];

    /**
     * Get the order that owns the order item.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the movie that owns the order item.
     */
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    /**
     * Get the user that owns the order item.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the status label for display.
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Pending',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            default => 'Unknown'
        };
    }

    /**
     * Scope a query to only include order items with a specific status.
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
