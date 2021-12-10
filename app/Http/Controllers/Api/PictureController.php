<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Image;
use App\Apartment;
use Illuminate\Support\Facades\DB;

class PictureController extends Controller
{
    /**
     * Given an apartment @param slug @return the corresponding images paginated for 10
     */
    public function getApartmentImages($slug)
    {
        $apartment=Apartment::where('slug',$slug)->first();
        $pics = DB::table('images')->where('id', $apartment->id)->paginate(10);
        return response()->json([           
            'success' => true,
            'data' => $pics
        ]);
    }
}
