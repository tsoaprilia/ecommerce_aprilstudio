<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'payment_receipt',
        'is_paid'
    ];

    // public function user(){
    //     return $this->belongsTo(User::class, 'user_id');

    // }

    public function user(){
        return $this->belongsTo(User::class);

    }

    public function transactions(){
        return $this->hasMany(Transaction::class); // 'order_id' is the foreign key.
       // return $this->hasMany(Transaction::class, 'order_id'); // 'order_id' is the foreign key.

    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }
}
