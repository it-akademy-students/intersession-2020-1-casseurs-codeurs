<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;

class StripeController extends Controller
{
    protected function checkout(Request $request){
        
        $token = $request->data['stripeToken']['id'];
        $stripe = new Stripe();
        $stripe = Stripe::make(config('stripe.api_key'));

       try {
        $charge = $stripe->charges()->create([
            'currency' => 'EUR',
            'amount'   => 50.49,
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
