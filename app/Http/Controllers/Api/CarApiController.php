<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Car;
use App\Setting;

class CarApiController extends Controller
{
        /** get all cars */
        public  function getAllCars (Request $request)
        {
            $apikey = $request->api_key;

            $data = Setting::first();

            if($apikey==$data->api_key){
                 // try {
                        $cars = Car::orderBy('id','desc')->get();
                        return response([
                                'cars' =>$cars,
                                'message'=>"cars data retrieve success.",
                                'error'=>false,
                                'status'=>200
                        ]);
                // } catch (\Exception $exception) {
        
                //     $response['message'] =  $exception->getMessage(); 
                //     $response['error'] =  true;

                //     return response()->json($response);
                // }
            }else{
                return response([
                    'message'=>"API Key Error!",
                    'error'=>true,
                    'status'=>400
                ]);
            }
           
           
        }
}
