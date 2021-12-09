<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use Dotenv\Result\Success;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::all();

        return response()->json([           
            'success' => true,
            'data' => $apartments
        ]);
    }
}
