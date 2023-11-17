<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function create_product(){
        return view('create_product');
    }

    public function store_product(Request $request){
        $request->validate([
            'name_product'=> 'required',
            'price' => 'required',
            'description' => 'required',
            'link' => 'required',
            'creator' => 'required',
            'kategori' => 'required',
            'image_product' => 'required'
        ]);

        $file = $request->file('image_product');
        $path = time() . '_' . $request->name_product . '.' . $file->getClientOriginalExtension();

        Storage::disk('public')->put($path, file_get_contents($file));




        product::create([
            'name_product'=>$request->name_product,
            'price'=>$request->price,
            'description'=>$request->description,
            'link'=>$request->link,
            'creator'=>$request->creator,
            'kategori'=>$request->kategori,
            'image_product'=>$path
        ]);

        return Redirect::route('create_product');
    }

    public function index_product(Request $request) {
        $search = $request->input('search');
        $category = $request->input('category');

        $query = Product::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name_product', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($category) {
            $query->where('kategori', $category);
        }

        $products = $query->get();

        return view('index_product', compact('products'));
    }


    public function show_product(Product $product) {
        return view('show_product', compact('product'));
    }

    public function edit_product(Product $product){
        return view('edit_product', compact('product'));
    }

    public function update_product(Product $product, Request $request){
        $request->validate([
            'name_product'=> 'required',
            'price' => 'required',
            'description' => 'required',
            'link' => 'required',
            'creator' => 'required',
            'kategori' => 'required',
            'image_product' => 'required'
        ]);

        $file = $request->file('image_product');
        $path = time() . '_' . $request->name_product . '.' . $file->getClientOriginalExtension();

        Storage::disk('public')->put($path, file_get_contents($file));




        $product->update([
            'name_product'=>$request->name_product,
            'price'=>$request->price,
            'description'=>$request->description,
            'link'=>$request->link,
            'creator'=>$request->creator,
            'kategori'=>$request->kategori,
            'image_product'=>$path
        ]);

        return Redirect::route('index_product', $product);
    }

    public function delete_product(Product $product){
        $product->delete();
        return Redirect::route('index_product');
    }


    //show user
    public function show_product_user(Product $product) {
        return view('show_product_user', compact('product'));
    }
}
