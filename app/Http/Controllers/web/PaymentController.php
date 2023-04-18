<?php

namespace App\Http\Controllers\Web;

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

        return view('Web.payments.cart', [
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
        try {
        Cart::flush();
        return redirect()->back();
        return back()->with('success', "Password Changed Successfully");

        } catch (\Exception $e) {
            return  redirect()->back()->with('error', "Oops, something went wrong");
        }
    }
}
