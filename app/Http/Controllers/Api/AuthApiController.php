<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\FuelShop;
use App\Setting;
use App\ShopPhoto;
use Carbon\Carbon;

class AuthApiController extends Controller
{
	public function login(Request $request)
	{
		// dd($request->all());
		if(auth()->attempt(['loginId' => $request->login_id, 'password' => $request->password])){ 
            
           	$accessToken = auth()->user()->createToken('authToken')->accessToken;
   			
   			// $shop_data = FuelShop::where('licence_no',auth()->user()->loginId)->get();
   			$shop_data = new FuelShop();
   			$shop_data = $shop_data->leftjoin('state_divisions','state_divisions.id','=','fuel_shops.sd_id')->leftjoin('townships','townships.id','=','fuel_shops.tsh_id')->leftjoin('licences','licences.id','=','fuel_shops.licence_id')->select('fuel_shops.id','state_divisions.sd_name','townships.tsh_name_mm','townships.tsh_name_en','fuel_shops.shopName','fuel_shops.owner','fuel_shops.address','fuel_shops.lat','fuel_shops.lng','licences.licence_name','fuel_shops.licence_no','fuel_shops.shop_type','fuel_shops.shop_status','fuel_shops.lic_issue_date','fuel_shops.lic_expire_date','fuel_shops.remark','fuel_shops.c_by','fuel_shops.u_by')->where('licence_no',auth()->user()->loginId)->get();

   			$data =[
                    'id'=>auth()->user()->id,
                    'loginId'=>auth()->user()->loginId,
                    'role_id'=>auth()->user()->role_id,
                    'password'=>auth()->user()->password,
                    'shop_name'=>auth()->user()->name,
                    'email'=>auth()->user()->email,
                    'shop_id'=>$shop_data[0]->id,
                    'state_division'=>$shop_data[0]->state_division,
                    'tsh_name_mm'=>$shop_data[0]->tsh_name_mm,
                    'tsh_name_en'=>$shop_data[0]->tsh_name_en,
                    'owner'=>$shop_data[0]->owner,
                    'address'=>$shop_data[0]->address,
                    'lat'=>$shop_data[0]->lat,
                    'lng'=>$shop_data[0]->lat,
                    'licence_name'=>$shop_data[0]->licence_name,
                    'licence_no'=>$shop_data[0]->licence_no,
                    'shop_type'=>$shop_data[0]->shop_type,
                    'shop_status'=>$shop_data[0]->shop_status,
                    'lic_issue_date'=>$shop_data[0]->lic_issue_date,
                    'lic_expire_date'=>$shop_data[0]->lic_expire_date,
                    'remark'=>$shop_data[0]->remark,
                    'c_by'=>$shop_data[0]->c_by,
                    'u_by'=>$shop_data[0]->u_by,
                    
                 ];

            return response(['data' => $data, 'access_token' => $accessToken,'message'=>"Successfully login",'status'=>1,'ro_status'=>1]);
        } 
        else{ 
            return response(['message' => 'User name or password is invalid','status'=>0]);
        } 
	}

    public function change_password(Request $request)
    {
        // dd($request->all());
        $user_shop = User::find($request->shop_auth_id);

        if (Hash::check($request->old_password, $user_shop->password)) { 

           $user_shop->fill([
            'password' => Hash::make($request->new_password)
            ])->save();

           return response(['message' => 'Password change successful!','status'=>1]);

        } else {

            return response(['message' => 'Old password is incorrect!','status'=>0]);
        }
    }

    public function profile_update(Request $request)
    {
        $shop_photo_count = ShopPhoto::where('shop_id',$request->shop_id)->where('type',0)->get()->count();

        if ($shop_photo_count > 0) {

            $shop_photo = ShopPhoto::where('shop_id',$request->shop_id)->get();
            // dd($shop_photo[0]->name);

            $date = Carbon::now();
            $timeInMilliseconds = $date->getPreciseTimestamp(3);

            $destinationPath = public_path() . '/uploads/shop_photos/';

            $photos = ($request->photo != '') ? $request->photo : $shop_photo[0]->name;
            // dd($photos);
                if ($file = $request->file('photo')) {
                    $photos = $request->file('photo');
                    $ext = '.'.$request->photo->getClientOriginalExtension();
                    $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $photos->getClientOriginalName());
                    $file->move($destinationPath, $fileName);
                    $photos = $fileName;
                }

            $photo_update = $shop_photo[0]->update([
                'name'=>$photos
            ]);

            return response(['message' => 'Success','status'=>1]);

        }else{
            // dd("here");
            $date = Carbon::now();
            $timeInMilliseconds = $date->getPreciseTimestamp(3);

            $destinationPath = public_path() . '/uploads/shop_photos/';
            $photo = "";
            if ($request->photo != null) {
                if ($file = $request->file('photo')) {
                    $extension = $file->getClientOriginalExtension();
                    $safeName = 'img'.$timeInMilliseconds.'.' . $extension;
                    $file->move($destinationPath, $safeName);
                    $photo = $safeName;
                }

                    $p = ShopPhoto::create([
                        'shop_id'=>$request->shop_id,
                        'type'=>0,
                        'path'=>'uploads/shop_photos/',
                        'name'=>$photo,
                        'photo_name'=>"ဆိုင်ပုံ",
                    ]);    

            }

            return response(['message' => 'Success','status'=>1]);
        }
        
    }
}