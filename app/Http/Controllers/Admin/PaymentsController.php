<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use App\Apartment;
use App\Sponsorship;
use App\User;
use Braintree\Gateway;
use Braintree\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    public function index($apartment_id, $sponsorship_id) {
        $apartment = Apartment::where('id', '=', $apartment_id)->first();
        $sponsorship = Sponsorship::where('id', '=', $sponsorship_id)->first();

        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'tztvrwyp3nd8psmg',
            'publicKey' => 'kmtj4xck39tfwxgc',
            'privateKey' => '395ddeb6d239f55621a2d6388fe76653'
        ]);
    
        $token = $gateway->ClientToken()->generate();
    
        return view('admin.sponsorships.index', compact('apartment', 'sponsorship'), [
            'token' => $token
        ]);
    }

    public function process(Request $request, $apartment_id, $sponsorship_id) {

        $apartment = Apartment::where('id', '=', $apartment_id)->first();
        $sponsorship = Sponsorship::where('id', '=', $sponsorship_id)->first();   
        $user = User::where('id', '=', $apartment->user_id)->first();
        $today = new DateTime('now');
        
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'tztvrwyp3nd8psmg',
            'publicKey' => 'kmtj4xck39tfwxgc',
            'privateKey' => '395ddeb6d239f55621a2d6388fe76653'
        ]);
        
        $amount = $request->amount;
        if($amount != $sponsorship->price) {
            return redirect()->route('admin.apartments.show', $apartment_id)->with('error', 'Transazione annullata.');
        }
        $nonce = $request->payment_method_nonce;
        
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => $user->first_name,
                'lastName' => $user->last_name,
                'email' => $user->email,
            ],
            'options' => [
                'submitForSettlement' => true
            ],
        ]);
        
        if ($result->success) {
            $transaction = $result->transaction;
            // header("Location: transaction.php?id=" . $transaction->id);

            $apartment->sponsorships()->attach($sponsorship->id , ['created_at' => $today]);
            
            return redirect()->route('admin.apartments.show', $apartment_id)->with('success', 'Pagamento effettuato.');
        } else {
            $errorString = "";
    
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
    
            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            return redirect()->route('admin.apartments.show', $apartment_id)->with('error', 'Transazione annullata. '.$result->message);
        };
    }
}