<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'cart_id',
        'customer_id',
        'payment_id',
        'order_date',
        'status',
    ];

    protected $casts = [
        'order_date' => 'date',
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Computed total
    public function getTotalAmountAttribute()
    {
        return $this->orderItems->sum(function ($item) {
            return $item->quantity * $item->price_at_purchase;
        });
    }
}
