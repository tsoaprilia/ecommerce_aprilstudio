<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class CartController extends Controller
{
    public function add_to_cart(Product $product, Request $request){
        $user_id = Auth::id();
        $product_id = $product->id;

        // Cek apakah produk sudah ada di keranjang pengguna
        $existing_cart = Cart::where('product_id', $product_id)
                             ->where('user_id', $user_id)
                             ->first();

        if ($existing_cart == null) {
            // Jika produk belum ada di keranjang, tambahkan produk ke keranjang
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $product_id
            ]);
            return Redirect::route('index_product')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
        } else {
            // Jika produk sudah ada di keranjang, beri pesan kesalahan
            return Redirect::route('index_product')->with('warning', 'Produk sudah ada di dalam keranjang.');
        }
    }


    public function show_cart(){
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();
        return view('show_cart', compact('carts'));
    }

    public function delete_cart(Cart $cart){
        $cart->delete();
        return Redirect::back();
    }
}
