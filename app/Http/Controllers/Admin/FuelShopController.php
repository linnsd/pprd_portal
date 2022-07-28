<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FuelShop;
use App\Township;
use App\ShopPhoto;
use App\ShopFuelCapacity;
use App\ShopDailyRecord;
use App\ShopPreorder;
use App\StateDivision;
use App\FuelType;
use App\LicenceName;
use DB;
use Carbon\Carbon;
use App\User;
use Hash;

class FuelShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fuel_shops = FuelShop::list($request);
        
        $count = $fuel_shops->get()->count();

        $fuel_shops = $fuel_shops->orderBy('fuel_shops.created_at','asc')->paginate(10);

        return view('admin.fuel_shops.index',compact('fuel_shops','count'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fuel_shops.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = FuelShop::store_data($request);
        if ($data == 1) {
            return redirect()->route('admin.fuel_shops.index')->with('success','Success');
        }else{
            return redirect()->route('admin.fuel_shops.index')->with('error','Something wrong!');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail_data = FuelShop::detail($id);
        $shop_photos = ShopPhoto::where('shop_id',$id)->where('type',0)->where('show_status',1)->get();
        $licence_photos = ShopPhoto::where('shop_id',$id)->where('type',1)->where('show_status',1)->get();
        
        $shop_fuel_list = new ShopFuelCapacity();

        $shop_fuel_list = $shop_fuel_list->leftjoin('fuel_types','fuel_types.id','=','shop_fuel_capacity.fuel_type')->select('fuel_types.id','fuel_types.fuel_type AS f_type','shop_fuel_capacity.*')->where('shop_fuel_capacity.shop_id',$id)->get();

        return view('admin.fuel_shops.detail',compact('detail_data','shop_photos','licence_photos','shop_fuel_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail_data = FuelShop::find($id);
        $shop_photos = ShopPhoto::where('shop_id',$id)->where('type',0)->where('show_status',1)->get();
        $licence_photos = ShopPhoto::where('shop_id',$id)->where('type',1)->where('show_status',1)->get();
        return view('admin.fuel_shops.edit',compact('detail_data','shop_photos','licence_photos'));
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
        $data_update = FuelShop::update_data($request->all(),$id,$request->photo_name,$request->lic_photo_name,$request->lic_grade_id);
        return redirect()->route('admin.fuel_shops.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = FuelShop::delete_data($id);

        if ($data == 0) {
            return redirect()->route('admin.fuel_shops.index')->with('error','Foreign key!');
        }else{
            return redirect()->route('admin.fuel_shops.index')->with('success','Success');
        }
        

    }

    public function get_tsh(Request $request)
    {
        $townships = Township::where('sd_id',$request->id)->get();
        echo "<option value=''>Select Township</opiton>";
            foreach ($townships as $key => $township) {
                echo "<option value='".$township->id."'>".$township->tsh_name_mm."</opiton>";
            }
    }

    public function change_shop_status(Request $request)
    {
        // dd($request->all());

        $fuel_shop = FuelShop::find($request->shop_id);
        $fuel_shop->shop_status = $request->status;
        $fuel_shop->remark = $request->remark;

        $fuel_shop->save();
        // return response()->json(['success'=>'Status change successfully.']);

        return redirect()->route('admin.fuel_shops.index')->with('success','Success');
    }

    public function main_shop_report(Request $request)
    {
        // $main_reports = StateDivision::all();
        $main_reports = new StateDivision();
        $main_reports = $main_reports->paginate(10);

        foreach ($main_reports as $key => $value) {
             $value->total_shop_count = FuelShop::where('sd_id',$value->id)->get()->count();
             $value->main_shop_count = FuelShop::where('sd_id',$value->id)->where('shop_type',1)->where('show_status',1)->get()->count();
             $value->fuel_list = $this->get_fuel_list($value->id);
         } 

        // dd($main_reports[0]);

       return view('admin.reports.main_shop_report',compact('main_reports'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function get_fuel_list($sd_id)
    {
        $fuel_lists = FuelType::where('status',1)->get();
        
        foreach ($fuel_lists as $key => $value) {
            $value->storage_capacity = $this->get_storage_capacity($sd_id,$value->id);
            $value->remain_capacity = $this->get_remain_capacity($sd_id,$value->id);
            $value->avg_capacity = $this->get_avg_capacity($sd_id,$value->id);
            $value->pre_order_capacity = $this->get_pre_order_capacity($sd_id,$value->id);
        }

        return $fuel_lists;
    }

    public function get_storage_capacity($sd_id,$fuel_id)
    {
        $main_shops = new ShopFuelCapacity();
        $main_shops = $main_shops->leftjoin('fuel_shops','fuel_shops.id','=','shop_fuel_capacity.shop_id')->select('shop_fuel_capacity.id','shop_fuel_capacity.max_capacity','shop_fuel_capacity.opening_balance','shop_fuel_capacity.avg_balance','shop_fuel_capacity.fuel_type')->where('fuel_shops.sd_id',$sd_id)->where('shop_type',1)->where('shop_fuel_capacity.fuel_type',$fuel_id)->get();

        $storage_capacity = 0;
        foreach ($main_shops as $key => $value) {
            $storage_capacity += $value->max_capacity;
        }

        return $storage_capacity;
    }

    public function get_remain_capacity($sd_id,$fuel_id)
    {
        $main_shops = new ShopFuelCapacity();
        $main_shops = $main_shops->leftjoin('fuel_shops','fuel_shops.id','=','shop_fuel_capacity.shop_id')->select('shop_fuel_capacity.id','shop_fuel_capacity.max_capacity','shop_fuel_capacity.opening_balance','shop_fuel_capacity.avg_balance','shop_fuel_capacity.fuel_type')->where('fuel_shops.sd_id',$sd_id)->where('shop_type',1)->where('shop_fuel_capacity.fuel_type',$fuel_id)->get();

        $remain_capacity = 0;
        foreach ($main_shops as $key => $value) {
            $remain_capacity += $value->opening_balance;
        }

        return $remain_capacity;
    }

    public function get_avg_capacity($sd_id,$fuel_id)
    {
        $main_shops = new ShopFuelCapacity();
        $main_shops = $main_shops->leftjoin('fuel_shops','fuel_shops.id','=','shop_fuel_capacity.shop_id')->select('shop_fuel_capacity.id','shop_fuel_capacity.max_capacity','shop_fuel_capacity.opening_balance','shop_fuel_capacity.avg_balance','shop_fuel_capacity.fuel_type')->where('fuel_shops.sd_id',$sd_id)->where('shop_type',1)->where('shop_fuel_capacity.fuel_type',$fuel_id)->get();

        $avg_capacity = 0;
        foreach ($main_shops as $key => $value) {
            $avg_capacity += $value->avg_balance;
        }

        return $avg_capacity;
    }

    public function get_pre_order_capacity($sd_id,$fuel_id)
    {
        $main_shops = new ShopPreorder();
        $main_shops = $main_shops->leftjoin('fuel_shops','fuel_shops.id','shop_preorder_fuel.pre_shop_id')->select('shop_preorder_fuel.id','shop_preorder_fuel.pre_capacity')->where('fuel_shops.sd_id',$sd_id)->where('shop_type',1)->where('shop_preorder_fuel.pre_fuel_type',$fuel_id)->get();
        $pre_order_capacity = 0;

        foreach ($main_shops as $key => $value) {
            $pre_order_capacity += $value->pre_capacity;
        }

        return $pre_order_capacity;

    }

    public function shop_photo_update(Request $request)
    {
        $attach_file = ShopPhoto::update_shop_photo($request->all());

         $shop_id = ShopPhoto::find($request->doc_id)->shop_id;

          return redirect()->route('admin.fuel_shops.edit', [$shop_id,'tab_active'=>2])->with('success','Success');
    }

    public function attach_delete(Request $request)
    {
       
        $shop_photo = ShopPhoto::find($request->attach_id)->update([
            'show_status'=>0
        ]);

        return redirect()->route('admin.fuel_shops.edit', [$request->shop_id,'tab_active'=>2])->with('success','Success');
    }

    public function lic_photo_update(Request $request)
    {
        $attach_file = ShopPhoto::update_lic_photo($request->all());

         $shop_id = ShopPhoto::find($request->lic_shop_id)->shop_id;

          return redirect()->route('admin.fuel_shops.edit', [$shop_id,'tab_active'=>3])->with('success','Success');
    }

    public function lic_photo_delete(Request $request)
    {
        $shop_photo = ShopPhoto::find($request->attach_id)->update([
            'show_status'=>0
        ]);

        return redirect()->route('admin.fuel_shops.edit', [$request->shop_id,'tab_active'=>3])->with('success','Success');
    }

    public function get_using_shop_fuel(Request $request)
    {
        $data = ShopFuelCapacity::where('fuel_type',$request->id)->where('shop_id',$request->shop_id)->get()->count();
        if ($data > 0) {
            return response()->json(0);
        }else{
            return response()->json(1);
        }
    }

    public function get_lic_prefix(Request $request)
    {
        // dd($request->all());
        $licences = new LicenceName();
        $licences = $licences->leftjoin('licence_groups','licence_groups.id','=','licence_names.lic_gp_id')->select('licence_groups.prefix_code')->find($request->lic_id);

        // dd($licences);

        if ($licences != null) {
            $prefix_code = $licences->prefix_code;
        }else{
            $prefix_code = null;
        }

        return response()->json($prefix_code);
    }

    public function shop_pass_update(Request $request)
    {
        // dd($request->all());
        $licence_no = FuelShop::find($request->shop_id)->licence_no;
        
        $update_password = User::where('loginId',$licence_no)->update([
            'password'=>Hash::make($request->login_password),
        ]);
        // dd("hello");
        return redirect()->route('admin.fuel_shops.show', [$request->shop_id,'tab_active'=>4])->with('success','Success');

    }
}
