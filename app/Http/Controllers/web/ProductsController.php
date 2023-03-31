<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

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
        return view('web.products.show', [
            "product" => $product,
        ]);
    }
}
