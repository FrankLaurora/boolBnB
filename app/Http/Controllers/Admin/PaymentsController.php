<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use App\Apartment;
use Braintree\Gateway;
use Braintree\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    public function index() {
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'tztvrwyp3nd8psmg',
            'publicKey' => 'kmtj4xck39tfwxgc',
            'privateKey' => '395ddeb6d239f55621a2d6388fe76653'
        ]);
    
        $token = $gateway->ClientToken()->generate();
    
        return view('admin.sponsorships.index', [
            'token' => $token
        ]);
    }

    public function process(Request $request) {
        $apartment = Apartment::all()->where('id', '=', 16);
        $today=new DateTime('now');
        dd($apartment);
        
        $apartment->sponsorships()->save();
        $apartment->sponsorships()->attach(1 , ['created_at' => $today]);

        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'tztvrwyp3nd8psmg',
            'publicKey' => 'kmtj4xck39tfwxgc',
            'privateKey' => '395ddeb6d239f55621a2d6388fe76653'
        ]);
    
        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;
    
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => 'Tony',
                'lastName' => 'Stark',
                'email' => 'tony@avengers.com',
            ],
            'options' => [
                'submitForSettlement' => true
            ],
        ]);
    
        if ($result->success) {
            $transaction = $result->transaction;
            // header("Location: transaction.php?id=" . $transaction->id);
    
            return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
        } else {
            $errorString = "";
    
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
    
            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            return back()->withErrors('An error occurred with the message: '.$result->message);
        };
    }
}