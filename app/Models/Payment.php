<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'subscription_id',
        'payment_method',
        'payment_type',
        'transaction_id',
        'amount',
        'currency',
        'status',
        'notes',
        'payment_details',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'payment_details' => 'array',
    ];

    /**
     * Get the user that owns the payment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the subscription that owns the payment.
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * Get the payment detail associated with the payment.
     */
    public function detail()
    {
        return $this->hasOne(PaymentDetail::class);
    }

    /**
     * Get the payable model (subscription or order).
     */
    public function payable()
    {
        return $this->detail ? $this->detail->payable : null;
    }

    /**
     * Scope a query to only include subscription payments.
     */
    public function scopeSubscriptions($query)
    {
        if (Schema::hasColumn('payments', 'payment_type')) {
            return $query->where('payment_type', 'subscription');
        } else {
            return $query->whereNotNull('subscription_id');
        }
    }

    /**
     * Scope a query to only include movie purchase payments.
     */
    public function scopeMoviePurchases($query)
    {
        if (Schema::hasColumn('payments', 'payment_type')) {
            return $query->where('payment_type', 'movie_purchase');
        } else {
            return $query->whereNull('subscription_id');
        }
    }

    /**
     * Scope a query to only include payments with a specific status.
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include completed payments.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope a query to only include pending payments.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include failed payments.
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Scope a query to only include refunded payments.
     */
    public function scopeRefunded($query)
    {
        return $query->where('status', 'refunded');
    }

    /**
     * Determine if the payment is completed.
     */
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    /**
     * Determine if the payment is pending.
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Determine if the payment has failed.
     */
    public function hasFailed()
    {
        return $this->status === 'failed';
    }

    /**
     * Determine if the payment has been refunded.
     */
    public function isRefunded()
    {
        return $this->status === 'refunded';
    }
}
