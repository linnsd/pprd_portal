<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
use Hash;
use App\User;
class FuelShop extends Model
{
    protected $table = 'fuel_shops';
    protected $fillable = ['sd_id','tsh_id','shopName','owner','address','lat','lng','licence_id','licence_no','type','shop_status','shop_type','lic_issue_date','lic_expire_date','remark','c_by','u_by','show_status','lic_grade'];

    public function fuels()
    {
        return $this->hasMany('App\ShopFuelCapacity','shop_id');
    }

    public function daily_fuel()
    {
        return $this->hasMany('App\ShopDailyRecord','shop_id');
    }

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function state_division()
    {
        return $this->hasOne('App\StateDivision','id','sd_id');
    }

    public function township()
    {
        return $this->hasOne('App\Township','id','tsh_id');
    }

    public function licence()
    {
        return $this->hasOne('App\Licence','id','licence_id');
    }

    public static function list($request)
    {
        // dd($request->all());
        $fuel_shops = new FuelShop();
        $fuel_shops = $fuel_shops->leftjoin('state_divisions','state_divisions.id','=','fuel_shops.sd_id')->leftjoin('townships','townships.id','=','fuel_shops.tsh_id')->leftjoin('licences','licences.id','=','fuel_shops.licence_id')->leftjoin('lic_grades','lic_grades.id','=','fuel_shops.lic_grade')->select('fuel_shops.id','fuel_shops.shopName','state_divisions.sd_name','townships.tsh_name_mm','fuel_shops.owner','fuel_shops.licence_no','fuel_shops.shop_type','fuel_shops.shop_status','fuel_shops.lic_issue_date','fuel_shops.lic_expire_date','fuel_shops.address','lic_grades.grade')->where('show_status',1);
        if ($request->keyword != null) {
            $fuel_shops = $fuel_shops->where('fuel_shops.shopName','like','%'.$request->keyword.'%')->orWhere('fuel_shops.licence_no','like','%'.$request->keyword.'%');
        }
        if ($request->sd_id != null) {
            $fuel_shops = $fuel_shops->where('fuel_shops.sd_id',$request->sd_id);
        }

        if ($request->tsh_id != null) {
            $fuel_shops = $fuel_shops->where('fuel_shops.tsh_id',$request->tsh_id);
        }

        if ($request->is_active != null) {
            $fuel_shops = $fuel_shops->where('fuel_shops.shop_status',$request->is_active);
        }

        if ($request->is_major != null) {
            $fuel_shops = $fuel_shops->where('fuel_shops.shop_type',$request->is_major);
        }

        if ($request->lic_grade != null) {
            $fuel_shops = $fuel_shops->where('fuel_shops.lic_grade',$request->lic_grade);
        }

        return $fuel_shops;
    }

    public static function store_data($request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {

            $log_id = $request->lic_prefix.$request->licence_no;

            $user_count = User::where('loginId',$log_id)->get()->count();
            // dd($user_count);
            if ($user_count == 0) {
                $user = User::create([
                'role_id'=>5,
                'status'=>1,
                'sd_id'=>$request->sd_id,
                'loginId'=>($request->lic_prefix.$request->licence_no),
                'name'=>$request->shop_name,
                'password'=>Hash::make(123456),
            ]);
            $shop_fuel = FuelShop::create([
            'sd_id'=>$request->sd_id,
            'tsh_id'=>$request->tsh_id,
            'shopName'=>$request->shop_name,
            'owner'=>$request->owner,
            'address'=>$request->location,
            'lat'=>$request->lat,
            'lng'=>$request->lng,
            'licence_id'=>$request->licence_id,
            'licence_no'=>($request->lic_prefix.$request->licence_no),
            'shop_type'=>$request->shop_type,
            'lic_grade'=>$request->lic_grade_id,
            'shop_status'=>1,
            'lic_issue_date'=>date('Y-m-d',strtotime($request->issue_date)),
            'lic_expire_date'=>date('Y-m-d',strtotime($request->expire_date)),
            'remark'=>$request->remark,
            'c_by'=>auth()->user()->name,

        ]);

        $date = Carbon::now();
        $timeInMilliseconds = $date->getPreciseTimestamp(3);

        $destinationPath = public_path() . '/uploads/shop_photos/';
        $photo = "";
        if ($request->photo_name != null) {
                foreach ($request->photo_name as $key => $img) {
                if ($file = $img) {
                $extension = $file->getClientOriginalExtension();
                $safeName = 'img'.$timeInMilliseconds.$key.'.' . $extension;
                $file->move($destinationPath, $safeName);
                $photo = $safeName;
            }

                $p = ShopPhoto::create([
                    'shop_id'=>$shop_fuel->id,
                    'type'=>0,
                    'path'=>'uploads/shop_photos/',
                    'name'=>$photo,
                    'photo_name'=>$file_name[$key],
                ]);    

            }
        }

        $licence_path = public_path() . '/uploads/licence_photos/';

        $lic_photo = "";
        if ($request->lic_photo_name != null) {
                foreach ($request->lic_photo_name as $key => $img) {
                if ($file = $img) {
                $extension = $file->getClientOriginalExtension();
                $safeName = 'img'.$timeInMilliseconds.$key.'.' . $extension;
                $file->move($licence_path, $safeName);
                $lic_photo = $safeName;
            }

                $p = ShopPhoto::create([
                    'shop_id'=>$shop_fuel->id,
                    'type'=>1,
                    'path'=>'uploads/licence_photos/',
                    'name'=>$lic_photo,
                    'photo_name'=>$lic_file_name[$key],
                ]);    

            }
        }
    }else{
        return 0;
    }
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return 0;
        }

        return 1;
    }

    public static function detail($id)
    {
        $fuel_shops = new FuelShop();
        $fuel_shops = $fuel_shops->leftjoin('state_divisions','state_divisions.id','=','fuel_shops.sd_id')->leftjoin('townships','townships.id','=','fuel_shops.tsh_id')->leftjoin('licences','licences.id','=','fuel_shops.licence_id')->select('fuel_shops.id','fuel_shops.shopName','state_divisions.sd_name','townships.tsh_name_mm','fuel_shops.owner','fuel_shops.licence_no','fuel_shops.shop_type','fuel_shops.shop_status','fuel_shops.lic_issue_date','fuel_shops.lic_expire_date','licences.licence_name','fuel_shops.address','fuel_shops.lic_issue_date','fuel_shops.lic_expire_date')->find($id);
        return $fuel_shops;
    }

    public static function edit_data($id)
    {
        $fuel_shops = new FuelShop();
        $fuel_shops = $fuel_shops->leftjoin('state_divisions','state_divisions.id','=','fuel_shops.sd_id')->leftjoin('townships','townships.id','=','fuel_shops.tsh_id')->leftjoin('licences','licences.id','=','fuel_shops.licence_id')->select('fuel_shops.*')->find($id);
        return $fuel_shops;
    }

    public static function delete_data($id)
    {
           // $shop_fuel_capacity = ShopFuelCapacity::where('shop_id',$id)->get()->count();
           // $shop_daily_record = ShopDailyRecord::where('shop_id',$id)->get()->count();
           // $shop_preorder = ShopPreorder::where('pre_shop_id',$id)->get()->count();

           // if ($shop_fuel_capacity > 0 || $shop_daily_record > 0 || $shop_preorder > 0) {
           //     return 0;
           // }else{
           //      $shop_photo = ShopPhoto::where('shop_id',$id)->delete();

           //      $fuel_shops = FuelShop::find($id)->delete();

           //      return 1;
           // }

         $shop_photo = ShopPhoto::where('shop_id',$id)->update([
            'show_status'=>0
         ]);

        $show_status = FuelShop::find($id)->update([
            'show_status'=>0
        ]);

        return 1;
    }

    public static function update_data($param,$id,$photo_name,$lic_photo_name)
    {
        // dd($param);
        DB::beginTransaction();
        try {


            $shop_fuel = FuelShop::find($id);

            $user = User::where('loginId',$param['licence_no'])->update([
                'sd_id'=>$param['sd_id'],
                'loginId'=>$shop_fuel->licence_no,
                'name'=>$param['shop_name'],
            ]);

            $shop_fuel = $shop_fuel->update([
            'sd_id'=>$param['sd_id'],
            'tsh_id'=>$param['tsh_id'],
            'shopName'=>$param['shop_name'],
            'owner'=>$param['owner'],
            'address'=>$param['location'],
            'lat'=>$param['lat'],
            'lng'=>$param['lng'],
            'licence_id'=>$param['licence_id'],
            'licence_no'=>$param['licence_no'],
            'shop_type'=>$param['shop_type'],
            'lic_grade'=>$param['lic_grade_id'],
            'shop_status'=>1,
            'lic_issue_date'=>date('Y-m-d',strtotime($param['issue_date'])),
            'lic_expire_date'=>date('Y-m-d',strtotime($param['expire_date'])),
            'remark'=>$param['remark'],
            'u_by'=>auth()->user()->name,
        ]);

        $date = Carbon::now();
        $timeInMilliseconds = $date->getPreciseTimestamp(3);

        $destinationPath = public_path() . '/uploads/shop_photos/';
        $photo = "";
        if ($photo_name != null) {
                foreach ($photo_name as $key => $img) {
                if ($file = $img) {
                $extension = $file->getClientOriginalExtension();
                $safeName = 'img'.$timeInMilliseconds.$key.'.' . $extension;
                $file->move($destinationPath, $safeName);
                $photo = $safeName;
            }

                $p = ShopPhoto::create([
                    'shop_id'=>$id,
                    'type'=>0,
                    'path'=>'uploads/shop_photos/',
                    'name'=>$photo,
                    'photo_name'=>$param['file_name'][$key],
                ]);    

            }
        }

        $licence_path = public_path() . '/uploads/licence_photos/';

        $lic_photo = "";
        if ($lic_photo_name != null) {
                foreach ($lic_photo_name as $key => $img) {
                if ($file = $img) {
                $extension = $file->getClientOriginalExtension();
                $safeName = 'img'.$timeInMilliseconds.$key.'.' . $extension;
                $file->move($licence_path, $safeName);
                $lic_photo = $safeName;
            }

                $p = ShopPhoto::create([
                    'shop_id'=>$id,
                    'type'=>1,
                    'path'=>'uploads/licence_photos/',
                    'name'=>$lic_photo,
                    'photo_name'=>$param['lic_file_name'][$key],
                ]);    

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

