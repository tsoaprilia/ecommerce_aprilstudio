<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable=[
        'order_id',
        'product_id'
    ];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
        //return $this->hasOne(Order::class);
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id'); // 'product_id' is the foreign key.
    }
}
