<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\FuelShop;
use App\ShopDailyRecord;
use App\ShopPreorder;
use App\ShopFuelCapacity;
use App\NoReport;
use DB;

class DailyReportApiController extends Controller
{
	public function shop_daily_reports(Request $request)
	{
		// dd($request->all());
		$daily_lists = new ShopDailyRecord();
		$daily_lists = $daily_lists->leftjoin('fuel_types','fuel_types.id','=','shop_daily_record.fuel_type')->select('shop_daily_record.id','fuel_types.fuel_type','shop_daily_record.remark','shop_daily_record.created_at','shop_daily_record.report_time','shop_daily_record.fuel_balance AS opening_balance')->where('shop_daily_record.shop_id',$request->shop_id);

		if ($request->date != null) {
			// $from_date = date('Y-m-d',strtotime($request->from_date)).' 00:00:59';
			// $to_date = date('Y-m-d',strtotime($request->to_date)).' 23:59:59';

			$daily_lists = $daily_lists->whereDate('shop_daily_record.created_at',date('Y-m-d',strtotime($request->date)));
		}

		$daily_lists = $daily_lists->orderby('created_at','desc')->get();

		return response(['daily_lists' => $daily_lists,'message'=>"Success",'status'=>1]);
	}

	public function daily_report_detail(Request $request)
	{
		$daily_data = new ShopDailyRecord();
		$daily_data = $daily_data->leftjoin('fuel_types','fuel_types.id','=','shop_daily_record.fuel_type')->select('shop_daily_record.id','fuel_types.fuel_type','shop_daily_record.remark','shop_daily_record.created_at','shop_daily_record.report_time','shop_daily_record.max_capacity','shop_daily_record.fuel_balance','shop_daily_record.shop_id','shop_daily_record.daily_sale_capacity','shop_daily_record.avg_sale_capacity','shop_daily_record.available_day','shop_daily_record.pre_order_capacity','shop_daily_record.arrival_date','shop_daily_record.fuel_balance AS opening_balance')->find($request->report_id);

		return response(['daily_detail' => $daily_data,'message'=>"Success",'status'=>1]);
	}

	public function create_report(Request $request)
	{
		DB::beginTransaction();
        try {
                $daily_report = ShopDailyRecord::where('shop_id',$request->shop_id)->whereDate('created_at',date('Y-m-d'))->where('fuel_type',$request->fuel_type)->where('report_time',$request->report_time)->get()->count();


                if ($daily_report > 0) {
                    return response(['message'=>"Already Create!",'status'=>0]);
                }else{
                    if ($request->remain_day < 2) {
                    if ($request->is_order == 1) {
                        
                        $remark = $request->order_terminal." ".$request->order_company_name." မှ မှာယူထားပါသဖြင့် ".date('d-m-Y',strtotime($request->order_arrival_date))."တွင် ရောက်ရှိပါမည်။";

                        $pre_order = ShopPreorder::create([
                            'pre_shop_id'=>$request->shop_id,
                            'pre_comp_name'=>$request->order_company_name,
                            'pre_fuel_type'=>$request->fuel_type,
                            'pre_capacity'=>$request->order_capacity,
                            'pre_arrival_date'=>date('Y-m-d',strtotime($request->order_arrival_date)),
                            'pre_status'=>null,
                            'terminal'=>$request->order_terminal,
                            'bowser_no'=>$request->order_bowser_no,
                            'c_by'=>$request->created_name,
                            'pre_remark'=>$request->order_remark,
                        ]);

                        $daily_shop = ShopDailyRecord::create([
                            'shop_id'=>$request->shop_id,
                            'max_capacity'=>$request->max_capacity,
                            'fuel_type'=>$request->fuel_type,
                            'fuel_balance'=>$request->now_balance,
                            'daily_sale_capacity'=>$request->previous_balance - $request->now_balance,
                            'avg_sale_capacity'=>$request->avg_sale_capacity,
                            'available_day'=>($request->now_balance != 0 && $request->avg_sale_capacity != 0) ? (Int)($request->now_balance / $request->avg_sale_capacity): 0,

                            'remark'=>$remark,
                            'arrival_date'=>$request->order_arrival_date ? date('Y-m-d',strtotime($request->order_arrival_date)) : null,
                            'pre_order_capacity'=>$request->order_capacity,
                            'report_time'=>$request->report_time

                        ]);

                        $fuel_capacity = ShopFuelCapacity::where('shop_id',$request->shop_id)->where('fuel_type',$request->fuel_type)->update([
                            'opening_balance'=>$request->now_balance,
                        ]);

                        $no_report = NoReport::where('shop_id',$request->shop_id)->delete();

                    }elseif ($request->is_received == 1) {
                        $remark = "စက်သုံးဆီ".$request->order_capacity."ဂါလန် လက်ခံရရှိပါသည်။";

                        $pre_order = ShopPreorder::create([
                            'pre_shop_id'=>$request->shop_id,
                            'pre_comp_name'=>$request->order_company_name,
                            'pre_fuel_type'=>$request->fuel_type,
                            'pre_capacity'=>$request->order_capacity,
                            'pre_arrival_date'=>date('Y-m-d',strtotime($request->order_arrival_date)),
                            'pre_status'=>1,
                            'terminal'=>$request->order_terminal,
                            'bowser_no'=>$request->order_bowser_no,
                            'c_by'=>$request->created_name,
                            'pre_remark'=>$request->order_remark,
                        ]);


                        $daily_shop = ShopDailyRecord::create([
                            'shop_id'=>$request->shop_id,
                            'max_capacity'=>$request->max_capacity,
                            'fuel_type'=>$request->fuel_type,
                            'fuel_balance'=>($request->now_balance + $request->order_capacity),
                            'daily_sale_capacity'=>$request->previous_balance - $request->now_balance,
                            'avg_sale_capacity'=>$request->avg_sale_capacity,
                            'available_day'=>($request->now_balance != 0 && $request->avg_sale_capacity != 0) ? (Int)($request->now_balance / $request->avg_sale_capacity): 0,

                            'remark'=>$remark,
                            'arrival_date'=>$request->order_arrival_date ? date('Y-m-d',strtotime($request->order_arrival_date)) : null,
                            'pre_order_capacity'=>$request->order_capacity,
                            'report_time'=>$request->report_time

                        ]);

                        $op_balance = $request->order_capacity + $request->now_balance;

                        $fuel_capacity = ShopFuelCapacity::where('shop_id',$request->shop_id)->where('fuel_type',$request->fuel_type)->update([
                            'opening_balance'=>$op_balance,
                        ]);

                        $no_report = NoReport::where('shop_id',$request->shop_id)->delete();
                    }
                    else{

                        $fuel_capacity = ShopFuelCapacity::where('shop_id',$request->shop_id)->where('fuel_type',$request->fuel_type)->update([
                            'opening_balance'=>$request->now_balance,
                        ]);

                           $remark = "လက်ကျန်ဆီလျော့နည်းနေပါသည်။မှာယူထားခြင်းမရှိပါ";

                           $daily_shop = ShopDailyRecord::create([
                            'shop_id'=>$request->shop_id,
                            'max_capacity'=>$request->max_capacity,
                            'fuel_type'=>$request->fuel_type,
                            'fuel_balance'=>$request->now_balance,
                            'daily_sale_capacity'=>$request->previous_balance - $request->now_balance,
                            'avg_sale_capacity'=>$request->avg_sale_capacity,
                            'available_day'=>($request->now_balance != 0 && $request->avg_sale_capacity != 0) ? (Int)($request->now_balance / $request->avg_sale_capacity): 0,
                            'remark'=>$remark,
                            'arrival_date'=>$request->received_arrival_date ? date('Y-m-d',strtotime($request->received_arrival_date)) : null,
                            'pre_order_capacity'=>$request->order_capacity,
                           
                            'report_time'=>$request->report_time
                        ]);

                        $no_report = NoReport::where('shop_id',$request->shop_id)->delete();
                    }
                }else{
                    if ($request->is_order == 1) {
                        $remark = $request->order_terminal." ".$request->order_company_name." မှ မှာယူထားပါသဖြင့် ".date('d-m-Y',strtotime($request->order_arrival_date))."တွင် ရောက်ရှိပါမည်။";

                        $pre_order = ShopPreorder::create([
                            'pre_shop_id'=>$request->shop_id,
                            'pre_comp_name'=>$request->order_company_name,
                            'pre_fuel_type'=>$request->fuel_type,
                            'pre_capacity'=>$request->order_capacity,
                            'pre_arrival_date'=>date('Y-m-d',strtotime($request->order_arrival_date)),
                            'pre_status'=>null,
                            'terminal'=>$request->order_terminal,
                            'bowser_no'=>$request->order_bowser_no,
                            'c_by'=>$request->created_name,
                            'pre_remark'=>$request->order_remark,
                        ]);

                        $daily_shop = ShopDailyRecord::create([
                            'shop_id'=>$request->shop_id,
                            'max_capacity'=>$request->max_capacity,
                            'fuel_type'=>$request->fuel_type,
                            'fuel_balance'=>$request->now_balance,
                            'daily_sale_capacity'=>$request->previous_balance - $request->now_balance,
                            'avg_sale_capacity'=>$request->avg_sale_capacity,
                            'available_day'=>(Int)($request->now_balance / $request->avg_sale_capacity),
                            'remark'=>$remark,
                            'arrival_date'=>$request->order_arrival_date ? date('Y-m-d',strtotime($request->order_arrival_date)) : null,
                            'pre_order_capacity'=>$request->order_capacity,
                            'report_time'=>$request->report_time

                        ]);

                        $fuel_capacity = ShopFuelCapacity::where('shop_id',$request->shop_id)->where('fuel_type',$request->fuel_type)->update([
                            'opening_balance'=>$request->now_balance,
                        ]);

                        $no_report = NoReport::where('shop_id',$request->shop_id)->delete();

                    }elseif ($request->is_received == 1) {
                        $remark = "စက်သုံးဆီလုံလောက်မှုရှိပါသည်။ နောက်ထပ်"."စက်သုံးဆီ".$request->order_capacity."ဂါလန် လက်ခံရရှိပါသည်။";

                        $pre_order = ShopPreorder::create([
                            'pre_shop_id'=>$request->shop_id,
                            'pre_comp_name'=>$request->order_company_name,
                            'pre_fuel_type'=>$request->fuel_type,
                            'pre_capacity'=>$request->order_capacity,
                            'pre_arrival_date'=>date('Y-m-d',strtotime($request->order_arrival_date)),
                            'pre_status'=>1,
                            'terminal'=>$request->order_terminal,
                            'bowser_no'=>$request->order_bowser_no,
                            'c_by'=>$request->created_name,
                            'pre_remark'=>$request->order_remark,
                        ]);

                        $daily_shop = ShopDailyRecord::create([
                            'shop_id'=>$request->shop_id,
                            'max_capacity'=>$request->max_capacity,
                            'fuel_type'=>$request->fuel_type,
                            'fuel_balance'=>($request->now_balance + $request->order_capacity),
                            'daily_sale_capacity'=>$request->previous_balance - $request->now_balance,
                            'avg_sale_capacity'=>$request->avg_sale_capacity,
                            'available_day'=>(Int)($request->now_balance / $request->avg_sale_capacity),
                            'remark'=>$remark,
                            'arrival_date'=>$request->order_arrival_date ? date('Y-m-d',strtotime($request->order_arrival_date)) : null,
                            'pre_order_capacity'=>$request->order_capacity,
                            'report_time'=>$request->report_time

                        ]);

                        $op_balance = $request->order_capacity + $request->now_balance;

                        $fuel_capacity = ShopFuelCapacity::where('shop_id',$request->shop_id)->where('fuel_type',$request->fuel_type)->update([
                            'opening_balance'=>$op_balance,
                        ]);

                        $no_report = NoReport::where('shop_id',$request->shop_id)->delete();
                    }else{

                        // dd($request->now_balance);
                        $fuel_capacity = ShopFuelCapacity::where('shop_id',$request->shop_id)->where('fuel_type',$request->fuel_type)->update([
                            'opening_balance'=>$request->now_balance,
                        ]);

                           $remark = "လက်ကျန်ဆီလုံလောက်မှုရှိပါသဖြင့် စက်သုံးဆီမှာယူထားခြင်းမရှိပါ။ပုံမှန်အတိုင်းရောင်းချလျက်ရှိပါသည်။";

                           $daily_shop = ShopDailyRecord::create([
                            'shop_id'=>$request->shop_id,
                            'max_capacity'=>$request->max_capacity,
                            'fuel_type'=>$request->fuel_type,
                            'fuel_balance'=>$request->now_balance,
                            'daily_sale_capacity'=>$request->previous_balance - $request->now_balance,
                            'avg_sale_capacity'=>$request->avg_sale_capacity,
                            'available_day'=>($request->now_balance != 0 && $request->avg_sale_capacity != 0) ? (Int)($request->now_balance / $request->avg_sale_capacity): 0,
                            'remark'=>$remark,
                            'arrival_date'=>$request->received_arrival_date ? date('Y-m-d',strtotime($request->received_arrival_date)) : null,
                            'pre_order_capacity'=>$request->order_capacity,
                            
                            'report_time'=>$request->report_time
                        ]);

                        $no_report = NoReport::where('shop_id',$request->shop_id)->delete();
                    }
                }
                }

                
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                return response(['message'=>"Error",'status'=>0]);
            }	

            return response(['message'=>"Success",'status'=>1]);
	}

    public function order_list(Request $request)
    {
        // $order_list = ShopPreorder::where('shop_id',$request->shop_id);
        $order_list = new ShopPreorder();
        $order_list = $order_list->leftjoin('fuel_types','fuel_types.id','=','shop_preorder_fuel.pre_fuel_type')->select('shop_preorder_fuel.id','fuel_types.fuel_type','shop_preorder_fuel.pre_capacity','shop_preorder_fuel.pre_arrival_date','shop_preorder_fuel.pre_received_date','shop_preorder_fuel.pre_status')->where('shop_preorder_fuel.pre_shop_id',$request->shop_id);

        // dd($order_list);

        if ($request->date != null) {
            $date = date('Y-m-d',strtotime($request->date));

            $order_list = $order_list->where(function($query) use($date){
                $query->whereDate('shop_preorder_fuel.pre_arrival_date',$date);
            })->orWhere(function($query) use ($date){
                $query->whereDate('shop_preorder_fuel.pre_received_date',$date);
            });
        }

        $order_list = $order_list->orderBy('shop_preorder_fuel.created_at','desc')->limit(10)->paginate(10);

        return response(['message'=>"Success",'status'=>1,'order_list'=>$order_list]);

    }

    public function order_detail(Request $request)
    {
        $order_detail = new ShopPreorder();
        $order_detail = $order_detail->leftjoin('fuel_types','fuel_types.id','=','shop_preorder_fuel.pre_fuel_type')->select('shop_preorder_fuel.*','fuel_types.fuel_type AS fuel_name')->find($request->order_id);
        
        return response(['message'=>"Success",'status'=>1,'order_detail'=>$order_detail]);
    }
}