<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Cart;
use App\Models\Product;


class PaymentController extends Controller
{
    public function cart()
    {
        $carts = Cart::get();

        return view('web.payments.cart', [
            "carts" => $carts,
        ]);
    }
    public function addToCart(Request $request)
    {
        Cart::add($request->input('id'));
        // return response()->json('status' =>, 200, $headers);
    }
    public function removeFromCart(Request $request)
    {
        Cart::remove($request->input('id'));
        // return response()->json('status' =>, 200, $headers);
    }
    public function removeOneFromCart(Request $request)
    {
        Cart::removeOne($request->input('id'));
        // return response()->json('status' =>, 200, $headers);
    }
    public function clearCart(Request $request)
    {
        Cart::flush($request->input('id'));
        return redirect()->back();
    }
}
