<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::all();

        return response([
                'message' => "ok",
                'error'   => false,
                'data'    => $apartments,
                'meta' => [
                    'total'     => $apartments->count(),
                    'last_page' => ceil($apartments->count()/20)
                ]
            ],200);

    }//end of index

}//end of controller
