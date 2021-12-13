<?php

namespace App\Http\Controllers\Api;

use DateTime;
use App\Service;
use App\Apartment;
use Dotenv\Result\Success;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class ApartmentController extends Controller
{
    /**
     * Given an @param apartment returns @return apartment plus it's services ids and premium if it has it
     */
    function completeApartment($apartment){
        $today=new DateTime('now');
        $apartment->premium=false;

        //add check if the apartment is sponsored and add it as "premium" with value "true" or "false"
        foreach($apartment->sponsorships()->get() as $sponsor){
            $hoursdiff=false;
            $subscription_date=new DateTime($sponsor->pivot->created_at);
            $hoursdiff=($today->diff($subscription_date)->h)+($today->diff($subscription_date)->d)*24 + ($today->diff($subscription_date)->y)*365;
            if($hoursdiff<=$sponsor->duration){
                $apartment->premium=true;
            }
        }

        //add all the services id as [array_of_ids] associated to the apartments as "services"
        $services = [];
            foreach($apartment->services()->get() as $apartment_service){
                $services[] = $apartment_service->id;
            }
        $apartment->services = $services;
        return $apartment;
    }

    /**
     * Given an apartment @param slug returns @return apartment service
     */
    public function show($slug){
        $apartment=$this->completeApartment(Apartment::where('slug',$slug)->first());
        return response()->json([           
            'success' => true,
            'data' => $apartment
        ]);
    }
    
    /**
     * @return all apartments avaible 
     */
    public function index()
    {
        $response = Apartment::all();
        $apartments=[];
        foreach($response as $apartment){
            $apartments[]=$this->completeApartment($apartment)->paginate(10);
        }
        return response()->json([           
            'success' => true,
            'data' => $apartments
        ]);
    }

    /*api/apartments/search/
    ok 1)&lat=41.846020
    ok 2)&lon=13.535800
    ok 3)&dist=20
    4)&rooms=[5-10]
    5)&bathrooms=[1-2]
    6)&guests=[1-6]
    7)&sqm=[40-120]
    8)&address=via roma 47
    */
    // /api/apartments/search/&lat=41.846020&lon=12.535800&dist=25
    public function search($query){
        $response = Apartment::all();
        $apartments=[];
        $distanceRadius=20;//km
        $lat=null;
        $lon=null;
        $pieces = explode("&", $query);
        foreach($pieces as $piece){
            $piece=explode("=",$piece);
            if($piece[0]=='lat'){
                $lat=$piece[1];
            }
            if($piece[0]=='lon'){
                $lon=$piece[1];
            }
            if($piece[0]=='dist'){
                $distanceRadius=floatval($piece[1]);
            }
        }
        if($lat!=null&&$lon!=null){
            foreach($response as $apartment){
                if($this->calcDistance($lat,$lon,$apartment->latitude,$apartment->longitude)<=$distanceRadius){
                    $apartments[]=$this->completeApartment($apartment);
                }
            }
        }
        return response()->json([           
            'success' => true,
            'data' => $apartments
        ]);
    }

    /**
    * passing two cordinates as @param lat1,lon1,lat2,lon2 @return the distance between those two points
    * for test 41.846020,13.535800,40.846020,12.535800
     */
    public function calcDistance($lat1,$lon1,$lat2,$lon2)
    {
        $earthRay=6371;
        $radius1=pi()*$lat2/180;
        $radius2=pi()*$lat1/180;
        $distanceLat=($lat1-$lat2)*pi()/180;
        $distanceLon=($lon1-$lon2)*pi()/180;
        $a=sin($distanceLat/2)*sin($distanceLat/2)+cos($radius1)*cos($radius2)*sin($distanceLon/2)*sin($distanceLon/2);
        $c=2*atan2(sqrt($a),sqrt(1-$a));
        $distance = $earthRay*$c;
        return $distance;
    }
    
}