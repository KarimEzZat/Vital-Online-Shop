<?php

namespace App\Http\Controllers;

use App\Mail\PurchaseSuccessful;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\Charge;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout');
    }

    public function pay()
    {
        //dd(\request()->all());

        Stripe::setApiKey('sk_test_lwYPzuOSjUzF9sjVHwN6VT3a00PUEkrFpR');

        $charg = Charge::create([
            'amount' => \Cart::getTotal() * 100,
            'currency' => 'usd',
            'description' => 'Vital shop to sell books',
            'source' => \request()->stripeToken
        ]);

        session()->flash('success', 'Purchase successfully. wait for our email ...');
        Mail::to(\request()->stripeEmail)->send(new PurchaseSuccessful());
        \Cart::clear();

        return redirect('/');
    }
}
