<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ShopFuelCapacity;

use DB;
class ShopFuelCapacityController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        $shops = ShopFuelCapacity::list();

        if ($request->keyword != null) {
            $shops = $shops->where('fuel_shops.shopName','like','%'.$request->keyword.'%');
        }

        if ($request->sd_id != null) {
            $shops = $shops->where('fuel_shops.sd_id',$request->sd_id);
        }

        if ($request->tsh_id != null) {
            $shops = $shops->where('fuel_shops.tsh_id',$request->tsh_id);
        }

        $count = $shops->get()->count();

        $shops = $shops->orderBy('fuel_shops.created_at','asc')->paginate(10);

        return view('admin.fuel_capacity.index',compact('shops','count'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('admin.fuel_capacity.create');
    }

    public function store(Request $request)
    {
        $data = ShopFuelCapacity::store_data($request->all());

        return redirect()->route('admin.shop_fuel_capacity.index')->with('success','Success');
    }

    public function edit($id)
    {
        $edit_data = ShopFuelCapacity::edit_data($id);
        return view('admin.fuel_capacity.edit',compact('edit_data'));
    }

    public function update($id,Request $request)
    {
        $update_data = ShopFuelCapacity::update_data($id,$request->all());
        return redirect()->route('admin.shop_fuel_capacity.index')->with('success','Success');
    }

    public function destroy($id)
    {
       $data = ShopFuelCapacity::find($id)->update([
        'show_status'=>0
       ]);
       return redirect()->route('admin.shop_fuel_capacity.index')->with('success','Success');
    }

    public function number_update(Request $request)
    {
        // dd($request->all());
        $fuel = ShopFuelCapacity::find($request->fuel_id)->update([
            $request->name => $request->value,
        ]);

        $fuel_data = ShopFuelCapacity::find($request->fuel_id);
        return response()->json(['success' => true,'data'=>$fuel_data]);
    }

    public function lock_unlock_capacity($lock_unlock)
    {
        // dd($id);
        $affected = DB::table('shop_fuel_capacity')
                        ->update(['lock_unlock' => $lock_unlock]);
        return redirect()->route('admin.shop_fuel_capacity.index')->with('success','Success');
    }
}
