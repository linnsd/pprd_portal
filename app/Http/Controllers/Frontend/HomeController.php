<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\StateDivision;
use App\Car;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {   
        
        return view('frontend.home');
    }

    public  function widgetData()
    {
            $shopcountsArr = DB::table('state_divisions')
                 ->select('sd_name','mmr_code','sd_color', DB::raw('count(shops.id) as shoptotal'))
                 ->leftjoin('shops','shops.sd_id','=','state_divisions.id')
                 ->groupBy('sd_name','mmr_code','sd_color')
                 ->orderBy('mmr_code','asc')
                 ->get();


      $carscountsArr = DB::table('state_divisions')
                 ->select('mmr_code',DB::raw('count(cars.sd_id) as cartotal'))
                 ->leftjoin('cars','cars.sd_id','=','state_divisions.id')
                 ->groupBy('mmr_code')
                 ->orderBy('mmr_code','asc')
                 ->get();

        $stdivisions = StateDivision::orderBy('mmr_code','asc')->get();
        $approvedCarsArr = [];
        $carcount = 0; 

        foreach ($stdivisions as $key => $sd) {
            
            $cars_count = Car::where('sd_id',$sd->id)->whereNotNull('issue_date')->whereNotNull('expire_date')->get()->count();
                  $cartemp = [
                      "mmr_code"=>$sd->mmr_code,
                      "name"=>$sd->sd_name,
                      "approve_car_count" => $cars_count
                  ]; 
                  

          array_push($approvedCarsArr,$cartemp);
        }

         $dataArr =[];
         foreach ($shopcountsArr as $key => $data) {
              $temp = [
                          "mmr_code"=>$data->mmr_code,
                          "name"=>$data->sd_name,
                          "shopcount"=>$data->shoptotal,
                          "carcount"=>isset($approvedCarsArr[$key])?$approvedCarsArr[$key]["approve_car_count"]:0,
                          "color"=>$data->sd_color                     
                    ];

              array_push($dataArr,$temp);
         }

       $dataArr = json_encode($dataArr);


       return view('frontend.widget',compact('dataArr'));
    }

}
