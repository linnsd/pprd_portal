<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ShopFuelCapacity;

class ShopPreorder extends Model
{
    protected $table = 'shop_preorder_fuel';
    protected $fillable = ['pre_shop_id','pre_comp_name','pre_fuel_type','pre_capacity','pre_arrival_date','pre_received_date','pre_status','pre_remark','terminal','bowser_no','show_status','c_by','u_by','bowser_pre_no','bowser_pre_char','car_no'];

    public function pre_shop()
    {
        return $this->hasOne('App\FuelShop','id','pre_shop_id');
    }

    public static function list()
    {
        $data = new ShopPreorder();
        $data = $data->leftjoin('fuel_shops','fuel_shops.id','=','shop_preorder_fuel.pre_shop_id')->leftjoin('state_divisions','state_divisions.id','=','fuel_shops.sd_id')->leftjoin('townships','townships.id','=','fuel_shops.tsh_id')->leftjoin('fuel_types','fuel_types.id','=','shop_preorder_fuel.pre_fuel_type')->leftjoin('terminals','terminals.id','=','shop_preorder_fuel.terminal')->select('shop_preorder_fuel.id','fuel_shops.shopName','state_divisions.sd_name','townships.tsh_name_mm','shop_preorder_fuel.pre_fuel_type','shop_preorder_fuel.pre_capacity','shop_preorder_fuel.pre_arrival_date','shop_preorder_fuel.pre_status','shop_preorder_fuel.pre_remark','shop_preorder_fuel.bowser_no','shop_preorder_fuel.terminal','fuel_types.fuel_type','terminals.company_name')->where('shop_preorder_fuel.show_status',1);
        return $data;
    }

    public static function store_data($param,$received_date,$remark)
    {
        // dd($param);

        $car_no = $param['prefix_number'].$param['prefix_code'].'/'.$param['bowser_no'];
        // dd($car_no);

        $data = ShopPreorder::create([
            'pre_shop_id'=>$param['f_shop_id'],
            'pre_comp_name'=>$param['pre_company'],
            'pre_fuel_type'=>$param['fuel_type'],
            'pre_capacity'=>$param['pre_capacity'],
            'pre_arrival_date'=>date('Y-m-d',strtotime($param['arrival_date'])),
            'pre_received_date'=>$received_date ? date('Y-m-d',strtotime($received_date)) : null,
            'pre_status'=>$param['pre_status'],
            'pre_remark'=>$remark,
            'terminal'=>$param['terminal_id'],
            'bowser_pre_no'=>$param['prefix_number'],
            'bowser_pre_char'=>$param['prefix_code'],
            'car_no'=>$param['bowser_no'],
            'bowser_no'=>$car_no,
            'c_by'=>auth()->user()->name,
        ]);

        return $data;
    }

    public static function update_data($param,$received_date,$remark,$id)
    {
        // dd($param);
        $pre_data = ShopPreorder::find($id);

        if ($param['pre_status'] == 1) {
            $shop_fuel_opening= ShopFuelCapacity::where('shop_id',$pre_data->pre_shop_id)->where('fuel_type',$param['fuel_type'])->orderby('created_at','desc')->first()->opening_balance;
            // dd($shop_fuel_opening);
            
            $op_balance = $shop_fuel_opening + $pre_data->pre_capacity;

            $shop_fuel_capacity= ShopFuelCapacity::where('shop_id',$pre_data->pre_shop_id)->where('fuel_type',$param['fuel_type'])->update([
                'opening_balance'=>$op_balance
            ]);

            $shop_daily_record = ShopDailyRecord::where('shop_id',$pre_data->pre_shop_id)->where('fuel_type',$param['fuel_type'])->update([
                'remark'=>date('d-m-Y').' တွင် လက်ခံရရှိပါသည်'
            ]);
        }

        $car_no = $param['prefix_number'].$param['prefix_code'].'/'.$param['bowser_no'];
        
        $data = ShopPreorder::find($id)->update([
            'pre_shop_id'=>$param['f_shop_id'],
            'pre_comp_name'=>$param['pre_company'],
            'pre_fuel_type'=>$param['fuel_type'],
            'pre_capacity'=>$param['pre_capacity'],
            'pre_arrival_date'=>date('Y-m-d',strtotime($param['arrival_date'])),
            'pre_received_date'=>$received_date ? date('Y-m-d',strtotime($received_date)) : null,
            'pre_status'=>$param['pre_status'],
            'pre_remark'=>$remark,
            'terminal'=>$param['terminal_id'],
            'bowser_pre_no'=>$param['prefix_number'],
            'bowser_pre_char'=>$param['prefix_code'],
            'car_no'=>$param['bowser_no'],
            'bowser_no'=>$car_no,
            'u_by'=>auth()->user()->name
        ]);

        return $data;
    }

    public static function detail_data($id)
    {
        $data = new ShopPreorder();
        $data = $data->leftjoin('fuel_shops','fuel_shops.id','=','shop_preorder_fuel.pre_shop_id')->leftjoin('state_divisions','state_divisions.id','=','fuel_shops.sd_id')->leftjoin('townships','townships.id','=','fuel_shops.tsh_id')->leftjoin('terminals','terminals.id','=','shop_preorder_fuel.terminal')->select('shop_preorder_fuel.id','fuel_shops.shopName','state_divisions.sd_name','townships.tsh_name_mm','shop_preorder_fuel.pre_fuel_type','shop_preorder_fuel.pre_capacity','shop_preorder_fuel.pre_arrival_date','shop_preorder_fuel.pre_status','shop_preorder_fuel.pre_remark','shop_preorder_fuel.bowser_no','shop_preorder_fuel.terminal','shop_preorder_fuel.pre_received_date','shop_preorder_fuel.pre_comp_name','terminals.company_name')->find($id);
        return $data;
    }

}
