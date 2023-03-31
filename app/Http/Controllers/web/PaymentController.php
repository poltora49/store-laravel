<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $products = Product::query()
        ->orderBy("created_at", "DESC")->paginate(6);

        return view('web.products.index', [
            "products" => $products,
        ]);
    }
    public function cart()
    {
        $cart = Product::query()
        ->orderBy("created_at", "DESC")->paginate(6);

        return view('web.products.index', [
            "products" => $products,
        ]);
    }
}
