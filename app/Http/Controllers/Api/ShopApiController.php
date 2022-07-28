<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shops;
use App\Setting;
use App\Licence;

class ShopApiController extends Controller
{
    /** get all shops */
    public  function getAllShops(Request $request)
    {
        $apikey = $request->api_key;

        $data = Setting::first();

        if($apikey==$data->api_key){
            // try {
                $shops = Shops::orderBy('id','desc')->get();
                    return response([
                        'shops' =>$shops,
                        'message'=>"Shops data retrieve success.",
                        'error'=>false,
                        'status'=>200
                ]);
            // } catch (\Exception $exception) {

            //     $response['message'] =  $exception->getMessage();     
            //     return response()->json($response);
            // }
        }else{
            return response([
                    'message'=>"API Key Error!",
                    'error'=>true,
                    'status'=>400
            ]);
        }
       
    }

    public function getshopbylicence(Request $request)
    {
        // dd("Here");
        if ($request->licence_no != '') {
            // $shops = Shops::where('licence_no',$request->licence_no)->get();
            $shops = new Shops();
            $shops = $shops->leftJoin('licences','licences.id','=','shops.licence_id')
                        ->leftJoin('state_divisions','state_divisions.id','=','shops.sd_id')
                        ->leftJoin('townships','townships.id','=','shops.tsh_id')
                        ->select(
                            'shops.id',
                            'shops.user_id',
                            'shops.sd_id',
                            'state_divisions.sd_name',
                            'shops.tsh_id',
                            'townships.tsh_name_en',
                            'townships.tsh_name_mm',
                            'shops.licence_id',
                            'licences.licence_name',
                            'licences.licence_price',
                            'licences.extend_price',
                            'licences.expire_price',
                            'licences.destroy_price',
                            'licences.change_owner',
                            'licences.upgrade_storage',
                            'licences.change_name',
                            'shops.shop_name',
                            'shops.owner',
                            'shops.licence_no',
                            'shops.fuel_type',
                            'shops.storage',
                            'shops.expire_date',
                            'shops.location',
                            'shops.lat',
                            'shops.lng',
                            'shops.photo1',
                            'shops.photo2',
                            'shops.photo3',
                            'shops.photo4',
                            'shops.photo5',
                            'shops.photo6',
                            'shops.photo7',
                            'shops.photo8',
                            'shops.photo9',
                            'shops.photo10',
                            'shops.path',
                            'shops.created_at',
                            'shops.updated_at'
                        );
                $shops = $shops->where('licence_no',$request->licence_no)->get();
                return response([
                            'shops' =>$shops,
                            'message'=>"Shops data retrieve success.",
                            'error'=>false,
                            'status'=>200
                    ]);
                }else{
                    return response([
                            'message'=>"Licence no is require!",
                            'error'=>true,
                            'status'=>400
                    ]);
                }
        
    }
}
