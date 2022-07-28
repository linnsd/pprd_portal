<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ShopPreorder;
use App\ShopDailyRecord;

class ShopPreorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $pre_shops = ShopPreorder::list();

        if ($request->keyword != null) {
            $pre_shops = $pre_shops->where('fuel_shops.shopName','like','%'.$request->keyword.'%');
        }

        if ($request->received_status != null) {
            $pre_shops = $pre_shops->where('shop_preorder_fuel.pre_status',$request->received_status);
        }else{
            $pre_shops = $pre_shops->where('shop_preorder_fuel.pre_status',null);
        }


        $count = $pre_shops->get()->count();

        $pre_shops = $pre_shops->orderBy('shop_preorder_fuel.created_at','asc')->paginate(10);

        return view('admin.pre_shops.index',compact('pre_shops','count'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pre_shops.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = ShopPreorder::store_data($request->all(),$request->received_date,$request->pre_remark);
        return redirect()->route('admin.pre_shops.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail_data = ShopPreorder::detail_data($id);
        return view('admin.pre_shops.detail',compact('detail_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_data = ShopPreorder::find($id);
        // dd($edit_data);
        return view('admin.pre_shops.edit',compact('edit_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update_data = ShopPreorder::update_data($request->all(),$request->received_date,$request->pre_remark,$id);
        return redirect()->route('admin.pre_shops.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pre_shops = ShopPreorder::find($id);

        $shop_daily_record = ShopDailyRecord::where('shop_id',$pre_shops->pre_shop_id)->where('fuel_type',$pre_shops->pre_fuel_type)->get()->count();
        if ($shop_daily_record > 0) {
            return redirect()->route('admin.pre_shops.index')->with('error','Foreign Key!');
        }else{
            $pre_shops = ShopPreorder::find($id)->delete();
            return redirect()->route('admin.pre_shops.index')->with('success','Success');
        }
    }
}
