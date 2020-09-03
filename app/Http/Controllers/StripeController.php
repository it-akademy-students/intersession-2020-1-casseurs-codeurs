<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;

class StripeController extends Controller
{
    protected function checkout(Request $request){
        
        $token = $request->data['stripeToken']['id'];
        $stripe = new Stripe();
        $stripe = Stripe::make('sk_test_51HKQ6eEDdpH3cWNor0L1dwlEVt4rD0eOMEvLwo5BdNEaqjh3zFJ3XBWhD3shatgBsTkbeoYzPtMwWInLTDau9ixo00GyM3qQDY');

       try {
        $charge = $stripe->charges()->create([
            'currency' => 'EUR',
            'amount'   => 15.00,
            'source' => $token,
        ]);
        
        return [
            'status' => 'success'
        ];

         } catch (\Throwable $th) {
          
        return [
            'status' => 'error'
        ];

       }
    }
}
