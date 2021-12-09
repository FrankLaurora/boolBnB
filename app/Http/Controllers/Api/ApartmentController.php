<?php

namespace App\Http\Controllers\Api;

use DateTime;
use App\Service;
use App\Apartment;
use Dotenv\Result\Success;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::all();

        $today=new DateTime('now');

        foreach($apartments as $apartment){
            $apartment->premium=false;

            foreach($apartment->sponsorships()->get() as $sponsor){
                $hoursdiff=false;

                $subscription_date=new DateTime($sponsor->pivot->created_at);

                $hoursdiff=($today->diff($subscription_date)->h)+($today->diff($subscription_date)->d)*24 + ($today->diff($subscription_date)->y)*365;
                
                if($hoursdiff<=$sponsor->duration){
                    $apartment->premium=true;
                }
            }
        }
        
        foreach($apartments as $apartment) {
            $services = [];

            foreach($apartment->services()->get() as $apartment_service){
                $services[] = $apartment_service->id;
            }

            $apartment->services = $services;
        };

        foreach($apartments as $apartment) {
            $images = [];

            foreach($apartment->images()->get() as $apartment_image){
                $images[] = $apartment_image->id;
            }

            $apartment->images = $images;
        };

        return response()->json([           
            'success' => true,
            'data' => $apartments
        ]);
    }
}
