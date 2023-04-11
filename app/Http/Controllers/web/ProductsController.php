<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Favorite;

class ProductsController extends Controller
{
    public function home()
    {

        $categories = Category::query()->hidden()->get();
        $products = Product::query()->hidden()->limit(6)->get();

        return view('web.products.index', [
            "categories" => $categories,
            "products" => $products,
        ]);
    }
    public function index()
    {
        $categories = Category::query()->hidden()->get();
        $products = Product::query()->hidden()->paginate(12);

        return view('web.products.index', [
            "categories" => $categories,
            "products" => $products,
        ]);
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);

        if(auth()->check()){
            $favorite = Favorite::where(['user_id'=>auth()->user()->id, 'product_id'=>$product->id])->first();

            return view('web.products.show', [
                "product" => $product,
                "favorite" => $favorite,
            ]);
        }
        else return view('web.products.show', [
            "product" => $product,
        ]);
    }
    public function category($id){
        $category = Category::findOrFail($id);
        $products = Product::hidden()->categoryName($id)->paginate(12);

        return view('web.products.category', [
            "category" => $category,
            "products" => $products,
        ]);
    }
}
