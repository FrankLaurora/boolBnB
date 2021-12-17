<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Statistic;

class StatisticController extends Controller
{
    public function store($id, $ip) {
        
        $newStatistic = new Statistic();
        $newStatistic->apartment_id = $id;
        $newStatistic->ip_address = $ip;
        $newStatistic->save();

        return response()->json([           
            'success' => true,
            'data' => $newStatistic
        ]);
    }
}
