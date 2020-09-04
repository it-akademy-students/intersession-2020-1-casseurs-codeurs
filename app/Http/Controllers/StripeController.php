<?php

namespace App\Http\Controllers;

use App\Mail\DonateMail;
use Illuminate\Http\Request;
use Stripe;
use App\Models\Statistic;
use Illuminate\Support\Facades\Mail;
use Validator;



class StripeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stripe');
    }
      
     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stripe = Stripe::make('sk_test_51HKQ6eEDdpH3cWNor0L1dwlEVt4rD0eOMEvLwo5BdNEaqjh3zFJ3XBWhD3shatgBsTkbeoYzPtMwWInLTDau9ixo00GyM3qQDY');
    
            $donate = $stripe->charges()->create([
                'source' => $request->get('token'),
                'currency' => 'EUR',
                'amount' => $request->get('amount'),
                ]);

                $statistic = Statistic::first();
                $statistic->donation += intval($donate['amount']); //IMPORTANT=>la valeur doit être initialement de 0 pour s'incrémenter
                $statistic->save();

        $donatorMail = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
        ]);

        if ($donatorMail->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $donatorMail->errors()
            ], 422);
        }

        $amount=intval($donate['amount'])/100;
        Mail::to($request->email)->send(new DonateMail($amount));

        return response()->json(['status' => 'success'], 201);

        //return $donate;
    }
}

/* protected function checkout(Request $request){
    
    $token = $request->data['stripeToken']['id'];
    $stripe = new Stripe();
    $stripe = Stripe::make('sk_test_51HKQ6eEDdpH3cWNor0L1dwlEVt4rD0eOMEvLwo5BdNEaqjh3zFJ3XBWhD3shatgBsTkbeoYzPtMwWInLTDau9ixo00GyM3qQDY');

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
} */