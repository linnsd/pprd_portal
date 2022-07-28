<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FuelShop;
use DB;
class ShopFuelCapacity extends Model
{
    protected $table = 'shop_fuel_capacity';
    protected $fillable = ['shop_id','fuel_type','max_capacity','opening_balance','avg_balance','show_status','lock_unlock'];

    public function shop()
    {
        return $this->hasMany('App\FuelShop','id','shop_id');
    }

    public function f_type()
    {
        return $this->hasOne('App\FuelType','id','fuel_type');
    }

    public static function list()
    {
        // $data = new ShopFuelCapacity();
        // $data = $data->leftjoin('fuel_shops','fuel_shops.id','=','shop_fuel_capacity.shop_id')->leftjoin('state_divisions','state_divisions.id','=','fuel_shops.sd_id')->leftjoin('townships','townships.id','=','fuel_shops.tsh_id')->select('shop_fuel_capacity.*','fuel_shops.shopName','fuel_shops.owner','state_divisions.sd_name','townships.tsh_name_mm')->where('shop_fuel_capacity.show_status',1);

        // return $data;
        // $data = new FuelShop();
        // $data = $data->select('id','shopName')->get();
        // dd($data);

        // $search_alls=DB::table('fuel_shops as A')
        //         ->select('A.id','A.shopName')
        //         ->leftjoin('shop_fuel_capacity as B', function($join) {
        //             $join->on('A.id', '=', 'B.shop_id')->select('B.fuel_type');
        //         })
        //         ->groupBy('A.id')
        //         ->groupBy('A.shopName')
        //         ->get();

        // $search_alls = FuelShop::with('fuels')->get();

        // dd($search_alls);

        $data = new FuelShop();
        $data = $data->leftjoin('state_divisions','state_divisions.id','=','fuel_shops.sd_id')->leftjoin('townships','townships.id','=','fuel_shops.tsh_id')->select('fuel_shops.id','state_divisions.sd_name','townships.tsh_name_mm','fuel_shops.shopName','fuel_shops.owner')->with('fuels')->where('fuel_shops.shop_status',1);

        // dd($data);

        return $data;

    }

    public static function store_data($param)
    {
        foreach ($param['fuel_type'] as $key => $value) {
            $data = ShopFuelCapacity::create([
                'shop_id'=>$param['f_shop_id'],
                'fuel_type'=>$value,
                'max_capacity'=>$param['max_capacity'][$key],
                'opening_balance'=>$param['op_balance'][$key],
                'avg_balance'=>$param['avg_balance'][$key]
            ]);
        }
        return $data;
    }

    public static function edit_data($id)
    {
       $shop_fuel = new ShopFuelCapacity();
       $shop_fuel = $shop_fuel->leftjoin('fuel_shops','fuel_shops.id','=','shop_fuel_capacity.shop_id')->select('fuel_shops.shopName','shop_fuel_capacity.*')->find($id);

       return $shop_fuel;
    }

    public static function update_data($id,$param)
    {
        $fuel_capacity = ShopFuelCapacity::find($id)->update([
            'fuel_type'=>$param['fuel_type'],
            'max_capacity'=>$param['max_capacity'],
            'opening_balance'=>$param['opening_balance'],
            'avg_balance'=>$param['avg_balance']
        ]);

        return $fuel_capacity;
    }
}
