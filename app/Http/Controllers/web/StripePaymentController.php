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
        $transactions = Transaction::getForUser();

        return view('web.payments.list-transactions',[
            'transactions' =>$transactions
        ]);
    }

    public function webhook(Request $request)
    {

        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
        $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $endpoint_secret
        );
        } catch(\UnexpectedValueException $e) {
        // Invalid payload
            return response('', 400);
        exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
        // Invalid signature
        return response('', 400);
        }

        // Handle the event
        switch ($event->type) {
        case 'checkout.session.completed':
            $session = $event->data->object;

            $transaction = Transaction::where('session_id', $session->id)->first();
            // if($transaction && $transaction->status == 'unpaid') {
                $transaction->status = 'paid';
                $transaction->save();
            // }
        default:
            echo 'Received unknown event type ' . $event->type;
        }

        return response('');
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
                    route("stripe.succses",[],true)."?session_id={CHECKOUT_SESSION_ID}",
                "cancel_url" => route("transactions"),
        ]);
        Transaction::add($checkout_session);
        return redirect($checkout_session->url);
    }
    public function succses(Request $request){
        \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));
        $session_id = $request->get('session_id');

        try {
            $session = \Stripe\Checkout\Session::retrieve($session_id);
            if(!$session){
                return redirect()->route("transactions")->with('error', "Create payment cancelled");
            }
            // $customer = \Stripe\Customer::retrieve($session->custumer);

            $transaction = Transaction::where('user_id', auth()->user()->id)
                ->where('session_id', $session_id)
                ->where('status', 'unpaid')
                ->first();
            if(!$transaction){
                return redirect()->route("transactions")->with('error', "Create payment cancelled");
            }
            if($transaction && $transaction->status == 'unpaid'){
                $transaction->status = 'paid';
                $transaction->save();
            }

            Cart::flush();
            return redirect()->route("transactions")->with('success', "Create payment successfully");
        } catch (\Exception $e) {
            return redirect()->route("transactions")->with('error', "Create payment cancelled");
        }


    }
}
