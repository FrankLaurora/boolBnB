<?php

namespace App\Http\Controllers\Api;

use DateTime;
use App\Service;
use App\Apartment;
use Dotenv\Result\Success;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sponsorship;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
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
        $response = Apartment::paginate(12);
        $apartments=[];

        foreach($response as $apartment){
            $apartments[]=$this->completeApartment($apartment);
        }
        return response()->json([
            'success' => true,
            'currentPage'=>$response->currentPage(),
            'lastPage'=>$response->lastPage(),
            'data' => $apartments
        ]);
    }

    /*api/apartments/search/
    1)&lat=41.846020
    2)&lon=13.535800
    3)&dist=20
    4)&rooms=5
    5)&bathrooms=2
    6)&guests=3
    7)&sqm=60
    8)&services=1-2-3
    */
    // /api/apartments/search/&lat=41.846020&lon=12.535800&dist=25
    public function search($query){
        // $response = Apartment::all();
        // $apartments=[];
        $distanceRadius=20;//km
        $lat=null;
        $lon=null;
        $rooms=1;
        $bathrooms=0;
        $guests=0;
        $sqm=1;
        $paramscheck=true;
        $services=[];
        $pieces = explode("&", $query);
        foreach($pieces as $piece){
            $piece=explode("=",$piece);
            if($piece[0]=='lat'){
                $paramscheck=$this->paramCheck('lat',$piece[1]);
                $lat=$piece[1];
            }
            if($piece[0]=='lon'){
                $paramscheck=$this->paramCheck('lon',$piece[1]);
                $lon=$piece[1];
            }
            if($piece[0]=='dist'){
                $paramscheck=$this->paramCheck('dist',$piece[1]);
                $distanceRadius=floatval($piece[1]);
            }
            if($piece[0]=='rooms'){
                $paramscheck=$this->paramCheck('rooms',$piece[1]);
                $rooms=$piece[1];
            }
            if($piece[0]=='bathrooms'){
                $paramscheck=$this->paramCheck('bathrooms',$piece[1]);
                $bathrooms=$piece[1];
            }
            if($piece[0]=='guests'){
                $paramscheck=$this->paramCheck('guests',$piece[1]);
                $guests=$piece[1];
            }
            if($piece[0]=='sqm'){
                $paramscheck=$this->paramCheck('sqm',$piece[1]);
                $sqm=$piece[1];
            }
            if($piece[0]=='services'){
                $explodedServices=explode("-", $piece[1]);
                foreach($explodedServices as $singleService){
                    if($this->paramCheck('service',$singleService)==false){
                        return response()->json([           
                            'success' => false,
                            'data' => 'parameters invalid'
                        ]);
                    }
                    $services[]=$singleService;
                }
                $sqm=$piece[1];
            }
            if($paramscheck==false){
                return response()->json([           
                    'success' => false,
                    'data' => 'parameters invalid'
                ]);
            }
        }
        
        $deltaLon=$this->calcDistance($lat,$distanceRadius);
        $deltaLat=$distanceRadius/110.7;
        $services_number=count($services);
        $servicesArray=$services;
        $services=implode(',', $services);
        if($services_number>0){
            $response = DB::select( DB::raw("SELECT 
            apartment_id AS id ,rooms,bathrooms,guests_number,sqm,visibility,user_id,title,region,city,address,number,latitude,longitude,cover,slug,description, apartments.created_at, apartments.updated_at, COUNT(*) AS servicesNumber 
            FROM apartments 
            JOIN apartment_service ON apartments.id=apartment_service.apartment_id
            WHERE rooms>=$rooms AND
            longitude BETWEEN ($lon-$deltaLon) AND ($lon+$deltaLon) AND
            latitude BETWEEN ($lat-$deltaLat) AND ($lat+$deltaLat) AND
            bathrooms>=$bathrooms AND
            guests_number>=$guests AND
            sqm>=$sqm AND
            visibility=1 AND
            service_id IN ($services) GROUP BY apartment_id
            HAVING COUNT(*)>=$services_number"));
        }else{
            $response = DB::select(DB::raw("SELECT 
            id ,rooms,bathrooms,guests_number,sqm,visibility,user_id,title,region,city,address,number,latitude,longitude,cover,slug,description, created_at, updated_at
            FROM apartments 
            WHERE rooms>$rooms AND
            longitude BETWEEN ($lon-$deltaLon) AND ($lon+$deltaLon) AND
            latitude BETWEEN ($lat-$deltaLat) AND ($lat+$deltaLat) AND
            bathrooms>$bathrooms AND
            guests_number>$guests AND
            sqm>$sqm AND
            visibility=1"));
        }
        //checking time of sponsorship for premium true/false
        $today=new DateTime('now');
        foreach($response as $element){
            $element->services=$servicesArray;
            $sponsorResponse = DB::table('sponsorships')
                ->join('apartment_sponsorship', 'sponsorships.id', '=', 'apartment_sponsorship.sponsorship_id')
                ->where('apartment_id' ,'=', $element->id )
            ->get();
            $element->premium=false;
            foreach($sponsorResponse as $sponsor){
                $hoursdiff=false;
                $subscription_date=new DateTime($sponsor->created_at);
                $hoursdiff=($today->diff($subscription_date)->h)+($today->diff($subscription_date)->d)*24 + ($today->diff($subscription_date)->y)*365;
                if($hoursdiff<=$sponsor->duration){
                    $element->premium=true;
                }
            }
        }
        //paginate here
        $items = $response instanceof Collection ? $response : Collection::make($response);
        $page=null;
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        // The total number of items. If the `$items` has all the data, you can do something like this:
        $total = count($response);
        // How many items do you want to display.
        $perPage = 12;
        //pagination magic!
        $paginator= new LengthAwarePaginator($items->forPage($page, $perPage), $total, $perPage, $page);
        return response()->json([           
            'success' => true,
            'data' => $paginator
        ]);
    }

    public function paramCheck($name,$value){
        if(!is_numeric($value)){
            return false;
        }
        switch ($name) {
            case 'lat':
                if($value>90 || $value<-90){
                    return false;
                }
                break;
            case 'lon':
                if($value>180 || $value<-180){
                    return false;
                }
                break;
            case 'dist':
                if($value>999 || $value<=0){
                    return false;
                }
                break;
            case 'rooms':
                if($value>254 || $value<=0){
                    return false;
                }
                break;
            case 'bathrooms':
                if($value>254 || $value<0){
                    return false;
                }
                break;
            case 'guests':
                if($value>254 || $value<=0){
                    return false;
                }
                break;
            case 'sqm':
                if($value>32767 || $value<=0){
                    return false;
                }
                break;
        }
        return true;
    }

    /**
    * passing two cordinates as @param lat1,lon1,lat2,lon2 @return the distance between those two points
    * for test 41.846020,13.535800,40.846020,12.535800
     */
    // public function calcDistance($lat1,$lon1,$lat2,$lon2)
    // {
    //     $earthRay=6371;
    //     $radius1=pi()*$lat2/180;
    //     $radius2=pi()*$lat1/180;
    //     $distanceLat=($lat1-$lat2)*pi()/180;
    //     $distanceLon=($lon1-$lon2)*pi()/180;
    //     $a=sin($distanceLat/2)*sin($distanceLat/2)+cos($radius1)*cos($radius2)*sin($distanceLon/2)*sin($distanceLon/2);
    //     $c=2*atan2(sqrt($a),sqrt(1-$a));
    //     $distance = $earthRay*$c;
    //     return $distance;
    // }

    // given the latitude, returns the longitude difference (Delta Longitude) corresponding the given distance
    public function calcDistance($lat,$dist)
    {
        $earthRay=6371;
        $radius1=pi()*$lat/180;
        return (($dist*180)/(pi()*$earthRay*cos($radius1)));
    }
    
}