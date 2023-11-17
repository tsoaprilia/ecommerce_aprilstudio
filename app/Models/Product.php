<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[
        'name_product',
        'price',
        'description',
        'link',
        'creator',
        'kategori',
        'image_product'
    ];

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }
}
