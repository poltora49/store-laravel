<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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
        $request = Validator::make($request->all(), [
            'id' => ['required','exists:products,id'],
        ])->safe()->all();
        Cart::add($request['id']);
    }
    public function removeFromCart(Request $request)
    {
        $request = Validator::make($request->all(), [
            'id' => ['required','exists:cart,id'],
        ])->safe()->all();
        Cart::remove($request['id']);
    }
    public function removeOneFromCart(Request $request)
    {
        $request = Validator::make($request->all(), [
            'id' => ['required','exists:products,id'],
        ])->safe()->all();
        Cart::removeOne($request['id']);
    }
    public function clearCart()
    {
        Cart::flush();
        return redirect()->back();
    }
}
