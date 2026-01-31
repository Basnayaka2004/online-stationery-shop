<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'cart_item_id',
        'quantity',
        'price_at_purchase',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function cartItem()
    {
        return $this->belongsTo(CartItem::class);
    }
}
