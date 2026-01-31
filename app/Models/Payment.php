<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'cart_id',
        'order_id',
        'payment_method',
        'payment_amount',
        'payment_date',
       
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
