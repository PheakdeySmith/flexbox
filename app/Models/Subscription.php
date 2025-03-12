<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'subscription_plan_id',
        'status',
        'start_date',
        'end_date',
        'trial_ends_at',
        'canceled_at',
        'auto_renew',
        'stripe_id',
        'stripe_status',
        'stripe_price',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'trial_ends_at' => 'datetime',
        'canceled_at' => 'datetime',
        'auto_renew' => 'boolean',
    ];

    /**
     * Get the user that owns the subscription.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the plan that owns the subscription.
     */
    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id');
    }

    /**
     * Get the payments for the subscription.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the payment details for the subscription.
     */
    public function paymentDetail()
    {
        return $this->morphOne(PaymentDetail::class, 'payable');
    }

    /**
     * Determine if the subscription is active.
     */
    public function isActive()
    {
        return $this->status === 'active' &&
               ($this->end_date === null || $this->end_date->isFuture());
    }

    /**
     * Determine if the subscription is canceled.
     */
    public function isCanceled()
    {
        return $this->canceled_at !== null;
    }

    /**
     * Determine if the subscription is on trial.
     */
    public function onTrial()
    {
        return $this->trial_ends_at !== null &&
               $this->trial_ends_at->isFuture();
    }

    /**
     * Scope a query to only include active subscriptions.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                     ->where(function ($query) {
                         $query->whereNull('end_date')
                               ->orWhere('end_date', '>', now());
                     });
    }

    /**
     * Scope a query to only include canceled subscriptions.
     */
    public function scopeCanceled($query)
    {
        return $query->whereNotNull('canceled_at');
    }

    /**
     * Scope a query to only include on trial subscriptions.
     */
    public function scopeOnTrial($query)
    {
        return $query->whereNotNull('trial_ends_at')
                     ->where('trial_ends_at', '>', now());
    }

    /**
     * Cancel the subscription.
     */
    public function cancel()
    {
        $this->update([
            'status' => 'canceled',
            'canceled_at' => now(),
            'auto_renew' => false,
        ]);

        return $this;
    }
}
