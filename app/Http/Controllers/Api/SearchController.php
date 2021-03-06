<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {   
        $apartments = Apartment::where('city' , 'like', "%$request->search%")->get();
        \Cache::set('Apartment',$apartments ,30*60);//30min
        $page       = $request->input('page',1);

        return response([
                'message' => "ok",
                'error'   => false,
                'data'    => $apartments->forPage($page,20)->values(),
                'meta' => [
                    'total'     => $apartments->count(),
                    'page'      => $page,
                    'last_page' => ceil($apartments->count()/20)
                ]
            ],200);

        return response()->api($apartments);

    }//end of search

    public function advanced_search(Request $request)
    {
        $apartments = Apartment::WhenSearch($request->search)->get();
        \Cache::set('Apartment',$apartments ,30*60);//30min
        $page       = $request->input('page',1);

        return response([
                'message' => "ok",
                'error'   => false,
                'data'    => $apartments->forPage($page,20)->values(),
                'meta' => [
                    'total'     => $apartments->count(),
                    'page'      => $page,
                    'last_page' => ceil($apartments->count()/20)
                ]
            ],200);

        return response()->api($apartments);

    }//end of search
    
}//end of controller