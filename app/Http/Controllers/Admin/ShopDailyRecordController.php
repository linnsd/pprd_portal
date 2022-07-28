<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ShopDailyRecord;
use App\ShopFuelCapacity;
use App\FuelShop;
use App\ReportTime;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\CustomClasses\ColectionPaginate;
use Illuminate\Support\Facades\Redirect;
use URL;

class ShopDailyRecordController extends Controller
{
    public function index(Request $request)
    {
        $daily_records = ShopDailyRecord::list($request);
        
        $count = $daily_records->count();

         $daily_records = $this->paginate($daily_records);

         return view('admin.daily_records.index',compact('count','daily_records'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function paginate($items,$perPage = 10, $page = null, $options = [])
    {
        $url = URL::to('/').'/admin/daily_shop_reports?';

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), 
           $perPage,$page, array('path' => $url));

    }

    public function create()
    {
        return view('admin.daily_records.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $data = ShopDailyRecord::store_data($request);
        if ($data == 0) {
            return redirect()->route('admin.daily_shop_reports.index')->with('error','Something wrong!');
        }else{
            return redirect()->route('admin.daily_shop_reports.index')->with('success','Success');
        }
        
    }

    public function get_shop_fuel(Request $request)
    {
        // dd($request->all());
        // $fuel_list = ShopFuelCapacity::where('shop_id',$request->id)->get();
        $fuel_list = new ShopFuelCapacity();
        $fuel_list = $fuel_list->leftjoin('fuel_types','fuel_types.id','=','shop_fuel_capacity.fuel_type')->select('shop_fuel_capacity.*','fuel_types.fuel_type')->where('shop_id',$request->id)->get();
        // dd($fuel_list);
        return response()->json($fuel_list);
    }

    public function get_fuel_type_by_shop(Request $request)
    {
        // dd($request->all());
        $fuel_list = new ShopFuelCapacity();
        $fuel_list = $fuel_list->leftjoin('fuel_types','fuel_types.id','=','shop_fuel_capacity.fuel_type')->select('fuel_types.id','fuel_types.fuel_type','shop_fuel_capacity.shop_id')->where('shop_id',$request->id)->get();

        // dd($fuel_list);

        echo "<option value=''>စက်သုံးဆီ အမျိုးအစား</opiton>";
            foreach ($fuel_list as $key => $fuel) {
                // echo($fuel);
                $is_exit = ShopDailyRecord::where('shop_id',$fuel->shop_id)->where('fuel_type',$fuel->id)->whereDate('created_at',date('Y-m-d'))->first();

                if ($is_exit == null) {
                    echo "<option value='".$fuel->id."'>".$fuel->fuel_type."</opiton>";
                }
               
            }

    }

    public function get_report_time_by_shop(Request $request)
    {
        $fuel_shop = FuelShop::find($request->shop_id)->shop_type;
       
        if ($fuel_shop == 0) {
          $report_times = ReportTime::where('shop_type','1')->where('active_status',1)->get();
        }else{
          $report_times = ReportTime::where('active_status',1)->get();
        }
      
        echo "<option value=''>Reporting Time</opiton>";
            foreach ($report_times as $key => $report_time) {
                echo "<option value='".$report_time->rep_time."'>".$report_time->rep_time."</opiton>";
            }
    }

    public function get_prev_balance(Request $request)
    {
        // dd($request->all());
        $data = ShopFuelCapacity::where('shop_id',$request->shop_id)->where('fuel_type',$request->fuel_type_id)->first();
        $day = (Int)($data->opening_balance / $data->avg_balance);
        // dd($day);
        return response()->json([$data,$day]);
    }

    public function no_report_shops(Request $request)
    {
        $no_reports = ShopDailyRecord::no_report_list($request);

        $count = $no_reports->count();

        $no_reports = $this->no_report_paginate($no_reports);

        return view('admin.daily_records.no_report_shops',compact('no_reports','count'))->with('i', ($request->input('page', 1) - 1) * 10);

    }

     public function no_report_paginate($items,$perPage = 10, $page = null, $options = [])
    {
        $url = URL::to('/').'/admin/no_report_shops?';

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), 
           $perPage,$page, array('path' => $url));

    }

    public function dio_approve(Request $request)
    {
        if ($request->approve_type == 1) {
                $dio_approve = ShopDailyRecord::where('shop_id',$request->daily_report_id)->whereDate('created_at',date('Y-m-d',strtotime($request->rep_date)))->update([
                'dio_approve_date'=>date('Y-m-d',strtotime($request->approve_date)),
                'dio_approve_name'=>auth()->user()->name
            ]);
        }else{
                $dio_approve = ShopDailyRecord::where('shop_id',$request->daily_report_id)->whereDate('created_at',date('Y-m-d',strtotime($request->rep_date)))->update([
                'dio_approve_date'=>date('Y-m-d',strtotime($request->approve_date)),
                'admin_approve_name'=>auth()->user()->name
            ]);
        }
        

        return redirect()->route('admin.daily_shop_reports.index')->with('success','Success');
    }
}
