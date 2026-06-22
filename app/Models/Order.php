<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'shipping_city',
        'shipping_postal_code',
        'notes',
        'subtotal',
        'shipping',
        'discount',
        'total_amount',
        'currency',
        'status',
        'payment_status',
        'stripe_session_id',
        'stripe_payment_intent_id',
        'paid_at',
        'mail_sent_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'mail_sent_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
