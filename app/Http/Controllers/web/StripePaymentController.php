<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Session;
use Stripe;

class StripePaymentController extends Controller
{

    public function transactions(Request $request)
    {
        if( $request->query('status')){
            Transaction::add();
            Cart::flush();
            return redirect(route("transactions",['status'=>false]));
        }
        $transactions = Transaction::getForUser();

        return view('web.payments.list-transactions',[
            'transactions' =>$transactions
        ]);
    }

    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $carts= Cart::get();

        $total_price=0;
        $items_to_buy = [];

                foreach ($carts as $cart){
                    $product = Product::find($cart->product_id);
                    $total_price+=$cart->price*$cart->quantity;
                    $items_to_buy[]=[
                        "price_data" => [
                            "currency" => "usd",
                            "product_data" => [
                                "name" => $product->title,
                            ],
                            "unit_amount" => $cart->price,
                        ],
                        "quantity" => $cart->quantity,
                    ];
                }
        $checkout_session = \Stripe\Checkout\Session::create([
                'line_items' => $items_to_buy,
                'mode' => 'payment',
                "success_url" =>
                    route("transactions",['status'=>true]),
                "cancel_url" => route("transactions",['status'=>false]),
        ]);

        Session::flash('success', 'Payment successful!');

        return redirect($checkout_session->url);
    }
}
