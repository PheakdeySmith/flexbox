<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'notes',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order items for the order.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the payment details for the order.
     */
    public function paymentDetail()
    {
        return $this->morphOne(PaymentDetail::class, 'payable');
    }

    /**
     * Get the payment for the order through payment detail.
     */
    public function payment()
    {
        return $this->paymentDetail ? $this->paymentDetail->payment : null;
    }

    /**
     * Scope a query to only include orders with a specific status.
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Get all of the movies for the order.
     */
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'order_items')
                    ->withPivot('price')
                    ->withTimestamps();
    }
}
