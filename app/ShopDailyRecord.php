<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ShopFuelCapacity;
use App\ShopPreorder;
use App\NoReport;
use DB;

class ShopDailyRecord extends Model
{
    protected $table = 'shop_daily_record';

    protected $fillable = ['shop_id','max_capacity','fuel_type','fuel_balance','daily_sale_capacity','avg_sale_capacity','available_day','remark','dio_approve','admin_approve','arrival_date','pre_order_capacity','dio_approve_date','admin_approve_date','report_time','dio_approve_name','admin_approve_name'];

    public function shop()
    {
        return $this->hasOne('App\FuelShop','id','shop_id')->where('show_status',1);
    }

    public function shop_fuel_capacity()
    {
        return $this->hasOne('App\ShopFuelCapacity','id','shop_fuel_cap_id');
    }

    public static function no_report_list($request)
    {
        // dd($request->all());
        $no_report_list = new NoReport();
        $no_report_list = $no_report_list->leftjoin('fuel_shops','fuel_shops.id','=','no_reports.shop_id')->leftjoin('state_divisions','state_divisions.id','fuel_shops.sd_id')->leftjoin('townships','townships.id','=','fuel_shops.tsh_id')->select('fuel_shops.id','state_divisions.sd_name','townships.tsh_name_mm','fuel_shops.shopName','fuel_shops.owner','fuel_shops.address','fuel_shops.shop_type','fuel_shops.lic_issue_date','fuel_shops.lic_expire_date')->where('fuel_shops.show_status',1);

        if ($request->keyword != null) {
            $no_report_list = $no_report_list->where('fuel_shops.shopName','like','%'.$request->keyword.'%');
        }

        if ($request->sd_id != null) {
            $no_report_list = $no_report_list->where('fuel_shops.sd_id',$request->sd_id);
        }

        if ($request->tsh_id != null) {
            $no_report_list = $no_report_list->where('fuel_shops.tsh_id',$request->tsh_id);
        }

         $from_date = $request->from_date ? date('Y-m-d',strtotime($request->from_date)).' 00:00:59' : date('Y-m-d').' 00:00:59';
        $to_date = $request->to_date ? date('Y-m-d',strtotime($request->to_date)).' 23:59:59' : date('Y-m-d').' 23:59:59';


        if ($from_date != null && $to_date != null) {

           

            $no_report_list = $no_report_list->whereBetween('no_reports.created_at',[$from_date,$to_date]);
        }

        $no_report_list = $no_report_list->get();

        foreach ($no_report_list as $key => $value) {
            $value->fuel_list = ShopFuelCapacity::where('shop_id',$value->id)->where('show_status',1)->get();
        }

        // dd($no_report_list[0]);

        return $no_report_list;
    }

    public static function list($request)
    {   
        $current_hour = date('H') * 60 + date('i');

        $two_hour_report = (15 * 60) + 59;

        $six_hour_report = (21 * 60) + 59;

        $report_time = null;

        if ($current_hour >= 60 && $current_hour <= $two_hour_report) {
            $report_time = "02:00 PM";
        }elseif ($current_hour >= (16 * 60) && $current_hour <= $six_hour_report) {
            $report_time = "06:00 PM";
        }else{
            $report_time = "10:00 PM";
        }

        if ($request->report_time != null) {
            $report_time = $request->report_time;
        }else{
            $report_time = $report_time;
        }

        // dd($report_time);
        $report_date = $request->report_date != null ? date('Y-m-d',strtotime($request->report_date)) : date('Y-m-d');

        
        $shops = ShopDailyRecord::with('shop')
            ->groupBy('shop_id')
            ->where('report_time','=',$report_time)
            ->whereDate('created_at',$report_date)
            ->orderBy(DB::raw('COUNT(id)','desc'));
            // ->get(array('shop_id'));
        
        if ($request->fuel_shop_id != null) {
            $shops = ShopDailyRecord::with('shop')
            ->groupBy('shop_id')
            ->where('report_time','=',$report_time)
            ->whereDate('created_at',$report_date)
            ->where('shop_id',$request->fuel_shop_id)
            ->orderBy(DB::raw('COUNT(id)','desc'));
        }

        $shops = $shops->get(array('shop_id'));

        
        foreach ($shops as $key => $value) {
            $daily_record = ShopDailyRecord::where('shop_id',$value->shop_id)->whereDate('created_at',$report_date)->orderby('created_at','desc')->first();

            $value->shop_name = FuelShop::find($value->shop_id)->shopName;
            $value->report_time = $daily_record != null ? $daily_record->report_time : null;
            $value->dio_approve_date = $daily_record != null ? $daily_record->dio_approve_date : null;
            $value->dio_approve_name = $daily_record != null ? $daily_record->dio_approve_name : null;
            $value->admin_approve_name = $daily_record != null ? $daily_record->admin_approve_name : null;

            $value->fuel_list = ShopDailyRecord::fuel_list($value->shop_id,$report_date);
        }

        return $shops;

    }

    public static function fuel_list($shop_id,$report_date)
    {
        $shop_fuel_list = ShopFuelCapacity::where('shop_id',$shop_id)->get();
       
        foreach ($shop_fuel_list as $key => $value) {
            $daily_record = new ShopDailyRecord();
            $daily_record = $daily_record->leftjoin('fuel_types','fuel_types.id','=','shop_daily_record.fuel_type')->where('shop_daily_record.fuel_type',$value->fuel_type)->select('shop_daily_record.*','fuel_types.fuel_type')->where('shop_id',$shop_id)->whereDate('shop_daily_record.created_at',$report_date)->orderby('created_at','desc')->first();


            $value->fuel_type_name = FuelType::find($value->fuel_type)->fuel_type;
            $value->max_capacity = $daily_record != null ? $daily_record->max_capacity : 0;
            $value->opening_balance = $daily_record != null ? $daily_record->fuel_balance : 0;
            $value->avg_balance = $daily_record != null ? $daily_record->avg_sale_capacity : 0;
            $value->order_fuel = $daily_record != null ? $daily_record->pre_order_capacity : 0;
            $value->arrival_date = $daily_record != null ? $daily_record->arrival_date : null;
            $value->remark = $daily_record != null ? $daily_record->remark : null;
        }
        return $shop_fuel_list;
       
    }

    public static function store_data($request)
    {
        DB::beginTransaction();
        try {
                if ($request->remain_day < 2) {
                    if ($request->is_order == 1) {
                        $remark = $request->order_terminal." ".$request->order_company_name." မှ မှာယူထားပါသဖြင့် ".date('d-m-Y',strtotime($request->order_arrival_date))."တွင် ရောက်ရှိပါမည်။";

                        $pre_order = ShopPreorder::create([
                            'pre_shop_id'=>$request->f_shop_id,
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
                            'shop_id'=>$request->f_shop_id,
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

                        $fuel_capacity = ShopFuelCapacity::where('shop_id',$request->f_shop_id)->where('fuel_type',$request->fuel_type)->update([
                            'opening_balance'=>$request->now_balance
                        ]);

                        $no_report = NoReport::where('shop_id',$request->f_shop_id)->delete();

                    }elseif ($request->is_received == 1) {

                        $remark = "စက်သုံးဆီ".$request->order_capacity."ဂါလန် လက်ခံရရှိပါသည်။";

                        $pre_order = ShopPreorder::create([
                            'pre_shop_id'=>$request->f_shop_id,
                            'pre_comp_name'=>$request->received_company_name,
                            'pre_fuel_type'=>$request->fuel_type,
                            'pre_capacity'=>$request->capacity,
                            'pre_arrival_date'=>date('Y-m-d',strtotime($request->received_arrival_date)),
                            'pre_status'=>1,
                            'terminal'=>$request->received_terminal,
                            'bowser_no'=>$request->received_bowser_no,
                            'c_by'=>auth()->user()->name,
                            'pre_remark'=>$request->received_remark,
                        ]);

                    $daily_shop = ShopDailyRecord::create([
                            'shop_id'=>$request->f_shop_id,
                            'max_capacity'=>$request->max_capacity,
                            'fuel_type'=>$request->fuel_type,
                            'fuel_balance'=>$request->now_balance,
                            'daily_sale_capacity'=>$request->previous_balance - $request->now_balance,
                            'avg_sale_capacity'=>$request->avg_sale_capacity,
                            'available_day'=>(Int)($request->now_balance / $request->avg_sale_capacity),
                            'remark'=>$remark,
                            'arrival_date'=>$request->received_arrival_date ? date('Y-m-d',strtotime($request->received_arrival_date)) : null,
                            'pre_order_capacity'=>$request->capacity,
                            'dio_approve'=>1,
                            'admin_approve'=>1,
                            'dio_approve_date'=>date('Y-m-d'),
                            'admin_approve_date'=>date('Y-m-d'),
                            'report_time'=>$request->report_time
                        ]);

                        $op_balance = $request->capacity + $request->now_balance;

                        $fuel_capacity = ShopFuelCapacity::where('shop_id',$request->f_shop_id)->where('fuel_type',$request->fuel_type)->update([
                            'opening_balance'=>$op_balance
                        ]);

                         $no_report = NoReport::where('shop_id',$request->f_shop_id)->delete();
                    }else{

                        $fuel_capacity = ShopFuelCapacity::where('shop_id',$request->f_shop_id)->where('fuel_type',$request->fuel_type)->update([
                            'opening_balance'=>$request->now_balance 
                        ]);

                       $remark = "လက်ကျန်ဆီလျော့နည်းနေပါသည်။မှာယူထားခြင်းမရှိပါ";

                       $daily_shop = ShopDailyRecord::create([
                        'shop_id'=>$request->f_shop_id,
                        'max_capacity'=>$request->max_capacity,
                        'fuel_type'=>$request->fuel_type,
                        'fuel_balance'=>$request->now_balance,
                        'daily_sale_capacity'=>$request->previous_balance - $request->now_balance,
                        'avg_sale_capacity'=>$request->avg_sale_capacity,
                        'available_day'=>(Int)($request->now_balance / $request->avg_sale_capacity),
                        'remark'=>$remark,
                        'arrival_date'=>$request->received_arrival_date ? date('Y-m-d',strtotime($request->received_arrival_date)) : null,
                        'pre_order_capacity'=>$request->capacity,
                        'dio_approve'=>1,
                        'admin_approve'=>1,
                        'dio_approve_date'=>date('Y-m-d'),
                        'admin_approve_date'=>date('Y-m-d'),
                        'report_time'=>$request->report_time
                    ]);

                        $no_report = NoReport::where('shop_id',$request->f_shop_id)->delete();
                    }
                }else{
                    if ($request->is_order == 1) {
                        $remark = $request->order_terminal." ".$request->order_company_name." မှ မှာယူထားပါသဖြင့် ".date('d-m-Y',strtotime($request->order_arrival_date))."တွင် ရောက်ရှိပါမည်။";


                        $pre_order = ShopPreorder::create([
                            'pre_shop_id'=>$request->f_shop_id,
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
                            'shop_id'=>$request->f_shop_id,
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

                        $fuel_capacity = ShopFuelCapacity::where('shop_id',$request->f_shop_id)->where('fuel_type',$request->fuel_type)->update([
                            'opening_balance'=>$request->now_balance
                        ]);

                        $no_report = NoReport::where('shop_id',$request->f_shop_id)->delete();
                    }elseif ($request->is_received == 1) {
                         $remark = "စက်သုံးဆီလုံလောက်မှုရှိပါသည်။ နောက်ထပ်"."စက်သုံးဆီ".$request->order_capacity."ဂါလန် လက်ခံရရှိပါသည်။";

                         $pre_order = ShopPreorder::create([
                            'pre_shop_id'=>$request->f_shop_id,
                            'pre_comp_name'=>$request->received_company_name,
                            'pre_fuel_type'=>$request->fuel_type,
                            'pre_capacity'=>$request->capacity,
                            'pre_arrival_date'=>date('Y-m-d',strtotime($request->received_arrival_date)),
                            'pre_status'=>1,
                            'terminal'=>$request->received_terminal,
                            'bowser_no'=>$request->received_bowser_no,
                            'c_by'=>auth()->user()->name,
                            'pre_remark'=>$request->received_remark,
                        ]);

                    $daily_shop = ShopDailyRecord::create([
                            'shop_id'=>$request->f_shop_id,
                            'max_capacity'=>$request->max_capacity,
                            'fuel_type'=>$request->fuel_type,
                            'fuel_balance'=>$request->now_balance,
                            'daily_sale_capacity'=>$request->previous_balance - $request->now_balance,
                            'avg_sale_capacity'=>$request->avg_sale_capacity,
                            'available_day'=>(Int)($request->now_balance / $request->avg_sale_capacity),
                            'remark'=>$remark,
                            'arrival_date'=>$request->received_arrival_date ? date('Y-m-d',strtotime($request->received_arrival_date)) : null,
                            'pre_order_capacity'=>$request->capacity,
                            'dio_approve'=>1,
                            'admin_approve'=>1,
                            'dio_approve_date'=>date('Y-m-d'),
                            'admin_approve_date'=>date('Y-m-d'),
                            'report_time'=>$request->report_time
                        ]);

                        $op_balance = $request->capacity + $request->now_balance;

                  

                        $fuel_capacity = ShopFuelCapacity::where('shop_id',$request->f_shop_id)->where('fuel_type',$request->fuel_type)->update([
                            'opening_balance'=>$op_balance
                        ]);

                         $no_report = NoReport::where('shop_id',$request->f_shop_id)->delete();
                    }else{
                            $remark = "လက်ကျန်ဆီလုံလောက်မှုရှိပါသဖြင့် စက်သုံးဆီမှာယူထားခြင်းမရှိပါ။ပုံမှန်အတိုင်းရောင်းချလျက်ရှိပါသည်။";

                             $fuel_capacity = ShopFuelCapacity::where('shop_id',$request->f_shop_id)->where('fuel_type',$request->fuel_type)->update([
                                'opening_balance'=>$request->now_balance 
                            ]);


                           $daily_shop = ShopDailyRecord::create([
                            'shop_id'=>$request->f_shop_id,
                            'max_capacity'=>$request->max_capacity,
                            'fuel_type'=>$request->fuel_type,
                            'fuel_balance'=>$request->now_balance,
                            'daily_sale_capacity'=>$request->previous_balance - $request->now_balance,
                            'avg_sale_capacity'=>$request->avg_sale_capacity,
                            'available_day'=>(Int)($request->now_balance / $request->avg_sale_capacity),
                            'remark'=>$remark,
                            'arrival_date'=>$request->received_arrival_date ? date('Y-m-d',strtotime($request->received_arrival_date)) : null,
                            'pre_order_capacity'=>$request->capacity,
                            'dio_approve'=>1,
                            'admin_approve'=>1,
                            'dio_approve_date'=>date('Y-m-d'),
                            'admin_approve_date'=>date('Y-m-d'),
                            'report_time'=>$request->report_time
                        ]);

                         $no_report = NoReport::where('shop_id',$request->f_shop_id)->delete();
                    }
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                return 0;
            }
       

        return 1;
    }

    

}
