<?php

namespace App\Http\Controllers\Api;

use DateTime;
use App\Statistic;
use App\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class StatisticController extends Controller
{
    public function show($id, $month) {
        // $apartment = Apartment::where('id', '=', $id);

        // $user = Auth::user();

        // dd($user);

        // if($user->id != $apartment->user_id){
        //     return abort(404);
        // }
        $statistics = Statistic::all()->where('apartment_id', '=', $id);
        
        if($month == 'all') {
            $data = [];
            for($i = 1; $i <= 12; $i++){
                $data[$i] = [];
                foreach($statistics as $statistic){
                    $date = new DateTime($statistic->created_at);
                    if($date->format('n') == $i) {
                        array_push($data[$i], $statistic);
                    }
                }
            }
            return response()->json([           
                'success' => true,
                'data' => $data
            ]);
        } else {
            $data = [
                'Q1' => [],
                'Q2' => [],
                'Q3' => [],
                'Q4' => []
            ];
            foreach($statistics as $statistic) {
                $date = new DateTime($statistic->created_at);
                if($date->format('m') == $month){
                    if(1 <= $date->format('j') && $date->format('j') < 8){
                        array_push($data['Q1'], $statistic);
                    } elseif(8 <= $date->format('j') && $date->format('j') < 15){
                        array_push($data['Q2'], $statistic);
                    } elseif(15 <= $date->format('j') && $date->format('j') < 22){
                        array_push($data['Q3'], $statistic);
                    } else {
                        array_push($data['Q4'], $statistic);
                    }
                }
            }

            return response()->json([           
                'success' => true,
                'data' => $data
            ]);
        }


    }

    public function store($id, $ip) {
        $today=new DateTime('now');

        $newStatistic = new Statistic();
        $newStatistic->apartment_id = $id;
        $newStatistic->ip_address = $ip;

        $checks = Statistic::all()->where('ip_address', '=', $newStatistic->ip_address)->where('apartment_id', '=', $newStatistic->apartment_id);
        
        foreach($checks as $check) {
            if(($today->diff(new DateTime($check->created_at))->h) < 24) {
                return response()->json([           
                    'success' => false,
                    'data' => $check
                ]);
            } 
        }

        $newStatistic->save();

        return response()->json([           
            'success' => true,
            'data' => $today->diff(new DateTime($check[0]->created_at))->h
        ]);
    }
}
