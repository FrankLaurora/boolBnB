<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use Dotenv\Result\Success;
use App\Service;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::all();

        
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

        // die();

        
        // foreach($apartments as $apartment) {
        //     $sponsorships = [];

        //     foreach($apartment->sponsorships()->get() as $apartment_sponsorship){
        //         if($apartment_sponsorship->created_at )
        //         $sponsorships[] = $apartment_sponsorship->created_at;
        //     }

        //     $apartment->sponsorships = $sponsorships;
        // };

        return response()->json([           
            'success' => true,
            'data' => $apartments
        ]);
    }
}
