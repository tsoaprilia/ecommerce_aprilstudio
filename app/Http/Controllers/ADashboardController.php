<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;

class ADashboardController extends Controller
{
    public function dashboard()
    {
        // Mengambil jumlah user member
        $userCount = User::where('is_admin', false)->count();

        // Mengambil jumlah order
        $orderCount = Order::count();

        // Mengambil jumlah produk kategori "ui/ux"
        $uiUxProductCount = Product::where('kategori', 'ui/ux')->count();

        // Mengambil jumlah produk kategori "feeds"
        $feedsProductCount = Product::where('kategori', 'feeds')->count();

        // Menghitung total penghasilan dari transaksi order yang dilakukan oleh user member
        $totalEarnings = Transaction::whereHas('order', function ($query) {
            $query->where('is_paid', true)->whereHas('user', function ($query) {
                $query->where('is_admin', false);
            });
        })->join('products', 'transactions.product_id', '=', 'products.id')
          ->sum('products.price');

        // Menghitung jumlah total produk
        $totalProductsCount = Product::count();

         // Mengambil produk yang paling banyak dibeli
        $mostPurchasedProduct = Transaction::select('product_id', Product::raw('count(*) as total'))
        ->groupBy('product_id')
        ->orderByDesc('total')
        ->first();
        $mostPurchasedProduct = Product::find($mostPurchasedProduct->product_id);

         // Mengambil pengguna yang paling banyak melakukan transaksi
        // Mengambil pengguna yang paling banyak melakukan transaksi
        $mostActiveUser = Order::select('user_id', \DB::raw('count(*) as total'))
        ->where('is_paid', true)
        ->whereHas('user', function ($query) {
            $query->where('is_admin', false);
        })
        ->groupBy('user_id')
        ->orderByDesc('total')
        ->first();

        if ($mostActiveUser) {
        $mostActiveUser = User::find($mostActiveUser->user_id);
        }


        return view('ADashboard', compact('userCount', 'orderCount', 'uiUxProductCount', 'feedsProductCount', 'totalEarnings', 'totalProductsCount', 'mostPurchasedProduct', 'mostActiveUser'));
    }
}
