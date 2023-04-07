<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;


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
        $carts = Cart::get();
        return view('web.payments.cart', [
            "carts" => $carts,
        ]);
    }
    public function addToCart($id)
    {
        $cart = Cart::add($id);
        return redirect()->back();
    }
}
