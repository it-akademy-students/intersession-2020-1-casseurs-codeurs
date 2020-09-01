<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;

class StripeController extends Controller
{
    protected function checkout(Request $request){
        dd($request->all());
        // Stripe::setApiKey(config('stripe.publishable_key'));
        // $session = \Stripe\Checkout\Session::create([
        //     'payment_method_types' => ['card'],
        //     'line_items' => [[
        //         'price_data' => [
        //             'currency' => 'eur',
        //             'product_data' => [
        //                 'name' => 'T-shirt',
        //             ],
        //             'unit_amount' => $request->amount,
        //         ],
        //         'quantity' => 1,
        //     ]],
        //     'mode' => 'payment',
        //     'success_url' => 'http://localhost:8000/success',
        //     'cancel_url' => 'http://localhost:8000/cancel',
        // ]);
        // return response(['id' => $session->id], 200);
    }
}
