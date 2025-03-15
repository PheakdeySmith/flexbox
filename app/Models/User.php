<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_profile',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's profile photo URL.
     *
     * @return string|null
     */
    public function getProfilePhotoAttribute()
    {
        return $this->user_profile;
    }

    /**
     * Get the watchlist items for the user.
     */
    public function watchlist()
    {
        return $this->hasMany(Watchlist::class);
    }

    /**
     * Get the reviews written by the user.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the subscriptions for the user.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get the payments made by the user.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the orders for the user.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the order items for the user.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the active subscription for the user.
     */
    public function activeSubscription()
    {
        return $this->subscriptions()->active()->latest()->first();
    }

    /**
     * Check if the user has an active subscription.
     */
    public function hasActiveSubscription()
    {
        return $this->activeSubscription() !== null;
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user is a moderator.
     */
    public function isModerator()
    {
        return $this->role === 'moderator';
    }

    /**
     * Check if the user can watch a specific movie.
     */
    public function canWatchMovie(Movie $movie)
    {
        // If the movie is free, anyone can watch it
        if ($movie->is_free) {
            return true;
        }

        // Check if user has an active subscription
        $activeSubscription = $this->activeSubscription();
        if ($activeSubscription && $activeSubscription->isActive()) {
            return true;
        }

        // Check if user has purchased this movie
        $hasPurchased = $this->orderItems()
            ->where('movie_id', $movie->id)
            ->where('status', 'completed')
            ->exists();

        return $hasPurchased;
    }
    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }
}
