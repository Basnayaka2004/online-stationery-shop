<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class Customer extends Authenticatable
{
    use HasApiTokens,HasFactory,Notifiable;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'username',
        'password',
        'street',
        'city',
        'state',
        'zip',
        
    ];
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
 