<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ShopFuelCapacity;
use App\ReportTime;
use App\FuelShop;

class FuelListApiController extends Controller
{
	public function master_data(Request $request)
	{
		$fuel_lists = new ShopFuelCapacity();
		$fuel_lists = $fuel_lists->leftjoin('fuel_types','fuel_types.id','=','shop_fuel_capacity.fuel_type')->select('fuel_types.id','fuel_types.fuel_type','shop_fuel_capacity.opening_balance','shop_fuel_capacity.avg_balance','shop_fuel_capacity.max_capacity')->where('shop_id',$request->shop_id)->get();

		foreach ($fuel_lists as $key => $value) {

			$value->day = ($value->opening_balance != 0 && $value->avg_balance) ? (Int)($value->opening_balance / $value->avg_balance) : 0;
		}

		$shop_type = FuelShop::find($request->shop_id)->shop_type;

		if ($shop_type == 1) {
			$report_times = ReportTime::where('active_status',1)->get();
		}else{
			$report_times = ReportTime::where('active_status',1)->where('shop_type',1)->get();
		}
		

		return response(['fuel_lists' => $fuel_lists,'report_times'=>$report_times,'message'=>"Success",'status'=>1]);

	}
}