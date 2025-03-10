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
     * Get the plan that the subscription belongs to.
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
     * Scope a query to only include active subscriptions.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include canceled subscriptions.
     */
    public function scopeCanceled($query)
    {
        return $query->where('status', 'canceled');
    }

    /**
     * Scope a query to only include expired subscriptions.
     */
    public function scopeExpired($query)
    {
        return $query->where('status', 'expired');
    }

    /**
     * Determine if the subscription is active.
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Determine if the subscription is canceled.
     */
    public function isCanceled()
    {
        return $this->status === 'canceled';
    }

    /**
     * Determine if the subscription is expired.
     */
    public function isExpired()
    {
        return $this->status === 'expired';
    }

    /**
     * Determine if the subscription is on trial.
     */
    public function onTrial()
    {
        return $this->trial_ends_at && $this->trial_ends_at->isFuture();
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
