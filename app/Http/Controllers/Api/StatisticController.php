<?php

namespace App\Http\Controllers\Api;

use DateTime;
use App\Statistic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatisticController extends Controller
{
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
