<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Township;
use App\Shops;
use App\Car;
use App\StateDivision;
use Hash;
use DB;
use Charts;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /** 
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {    
      if(auth()->user()->role_id!==2){
        $shopcounts = DB::table('state_divisions')
                 ->select('sd_short','sd_color', DB::raw('count(shops.id) as total'))
                 ->leftjoin('shops','shops.sd_id','=','state_divisions.id')
                 ->groupBy('sd_short','sd_color')
                 ->get();
        $values=[];
        $labels=[];
        $colors= [];

        $totalcount= 0;
        foreach ($shopcounts as $key => $data) {
            $totalcount = $totalcount + $data->total;
           array_push($values, $data->total);
           array_push($labels, $data->sd_short);
           array_push($colors, $data->sd_color);
        }

        $title = 'Total Shops: '. number_format($totalcount);

        $shops_chart = Charts::create('bar', 'highcharts')
                  ->title($title)
                  ->elementLabel("Shops ")
                  ->labels($labels)
                  ->values($values)
                  ->colors($colors)
                  ->dimensions(1000, 400)
                  ->responsive(true);


        $shops_pie = Charts::create('pie', 'highcharts')
                  ->title($title)
                  ->elementLabel("Total Shops")
                  ->labels($labels)
                  ->values($values)
                  ->colors($colors)
                  ->dimensions(1000, 400)
                  ->responsive(true);


        $carscounts = DB::table('state_divisions')
                 ->select('sd_short','sd_color', DB::raw('count(cars.id) as total'))
                 ->leftjoin('cars','cars.sd_id','=','state_divisions.id')
                 ->groupBy('sd_short','sd_color')
                 ->get();

        $values=[];
        $labels=[];
        $colors= [];

        $totalcarcount= 0;
        foreach ($carscounts as $key => $car) {
          $totalcarcount = $totalcarcount + $car->total;
           array_push($values, $car->total);
           array_push($labels, $car->sd_short);
           array_push($colors, $car->sd_color);
        }

        $title = 'Total cars: '. number_format($totalcarcount);

        $cars_chart = Charts::create('bar', 'highcharts')
                  ->title($title)
                  ->elementLabel("Cars ")
                  ->labels($labels)
                  ->values($values)
                  ->colors($colors)
                  ->dimensions(1000, 400)
                  ->responsive(true);


         $stdivisions = StateDivision::get();
         $townships = Township::with('shops')->get();

         $lists = StateDivision::with('townships');

         $sdlists = [];

         if(auth()->user()->roles[0]->id==4){
          $sdlists = StateDivision::with('townships')->where('id',auth()->user()->sd_id)->get();
         }
         
         if($request->sd_id!=''){
              $lists = $lists->where('id',$request->sd_id)->get();
         }else{
              $lists = $lists->where('id',1)->get();
         }


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


         // $approvedCarsArr = DB::table('state_divisions')
         //           ->select('mmr_code',DB::raw('count(cars.sd_id) as approvedTotal'))
         //           ->leftjoin('cars','cars.sd_id','=','state_divisions.id')
         //           ->groupBy('mmr_code')
         //           ->orderBy('mmr_code','asc')
         //           ->get();

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
                          "carcount"=>$carscountsArr[$key]->cartotal,
                          "approvedCars"=> isset($approvedCarsArr[$key])?$approvedCarsArr[$key]["approve_car_count"]:0,
                          "color"=>$data->sd_color                       
                    ];

              array_push($dataArr,$temp);
         }

       $dataArr = json_encode($dataArr);

       return view('admin.dashboard2',compact('lists','townships','stdivisions','shops_chart','shops_pie','sdlists','cars_chart','dataArr'));
     }else{
        $lists="";
        $townships="";
        $stdivisions="";
        $shops_chart="";
        $shops_pie="";
        $sdlists="";
        $cars_chart="";
        $dataArr="";
        return view('admin.dashboard2',compact('lists','townships','stdivisions','shops_chart','shops_pie','sdlists','cars_chart','dataArr'));
     }
       
    }

    public function profile()
    {   
        return view('admin.profile.showprofile');
    }

    public function changePassword()
    {   
        return view('admin.profile.changepassword');
    }

    public function resetPassword(Request $request)
    {   

        $request->validate([
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $id = $request->user_id;
        $user = User::find($id);
        $password = $request->get('password');
        $user->email = $user->email;
        $user->password = Hash::make($password);
        $user->save();

        return redirect()->route('admin.profile')
                        ->with('success','Password reset successful!');
    }


}
