<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'payable_id',
        'payable_type',
    ];

    /**
     * Get the payment that owns the payment detail.
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * Get the payable model (subscription or order).
     */
    public function payable()
    {
        return $this->morphTo();
    }
}
