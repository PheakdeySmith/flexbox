<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPlan extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'billing_cycle',
        'duration_in_days',
        'has_trial',
        'trial_days',
        'is_active',
        'features',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:2',
        'duration_in_days' => 'integer',
        'has_trial' => 'boolean',
        'trial_days' => 'integer',
        'is_active' => 'boolean',
        'features' => 'array',
    ];

    /**
     * Get the subscriptions for the plan.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Scope a query to only include active plans.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include monthly plans.
     */
    public function scopeMonthly($query)
    {
        return $query->where('billing_cycle', 'monthly');
    }

    /**
     * Scope a query to only include yearly plans.
     */
    public function scopeYearly($query)
    {
        return $query->where('billing_cycle', 'yearly');
    }
}
