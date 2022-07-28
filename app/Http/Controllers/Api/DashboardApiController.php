<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ShopFuelCapacity;
use App\FuelShop;
use App\ShopDailyRecord;

class DashboardApiController extends Controller
{
	public function main_dashboard(Request $request)
    {
        $fuel_list = new ShopFuelCapacity();
        $fuel_list = $fuel_list->leftjoin('fuel_types','fuel_types.id','=','shop_fuel_capacity.fuel_type')->select('shop_fuel_capacity.id','fuel_types.id AS fuel_id','fuel_types.fuel_type','shop_fuel_capacity.max_capacity','shop_fuel_capacity.opening_balance')->where('shop_id',$request->shop_id)->get();

        $last_report = ShopDailyRecord::where('shop_id',$request->shop_id)->latest()->first();
        // dd($last_report_date);
        $report_date = $last_report != null ? date('d-m-Y h:i A',strtotime($last_report->created_at)) : null;

        return response(['fuel_list' => $fuel_list,'report_date'=>$report_date,'message'=>"Success",'status'=>1]);
    }
}