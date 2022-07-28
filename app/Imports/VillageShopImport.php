<?php

namespace App\Imports;

use App\VillageShop;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;
use Hash;

class ShopsImport implements ToCollection,WithHeadingRow
{
    // use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     $rowexpdate= str_replace('/','-',$row['expire_date']);
    //     $expdate= date('Y-m-d', strtotime($rowexpdate));
    //     return new Shops([
    //         'sd_id'=>$row['sd_id'],
    //         'tsh_id'=>$row['tsh_id'],
    //         'shop_name'=>$row['shop_name'],
    //         'owner'=>$row['owner'],
    //         'licence_no'=>$row['licence_no'],
    //         'fuel_type'=>$row['fuel_type'],
    //         'storage'=>$row['storage'],
    //         'expire_date'=>$expdate,
    //         'location'=>$row['location'],
    //         'lat'=>$row['lat'],
    //         'lng'=>$row['lat']
    //     ]);
        
    // }
    // 
     public function collection(Collection $rows)
    {



        DB::beginTransaction();
        try {

                foreach ($rows as $row) 
                {
                    $rowexpdate= str_replace('/','-',$row['expire_date']);
                    $expdate= date('Y-m-d', strtotime($rowexpdate));

                    $user = User::create(
                      [
                        'role_id'=>2,
                        'loginId'=>$row['licence_no'],
                        'name'=>$row['shop_name'],
                        'password'=>Hash::make('123456')
                      ]
                    );

                    $user->assignRole("Shop Owner");
       
                    $arr=[
                          'user_id'=>$user->id,
                          'sd_id'=>$row['sd_id'],
                          'tsh_id'=>$row['tsh_id'],
                          'shop_name'=>$row['shop_name'],
                          'owner'=>$row['owner'],
                          'licence_no'=>$row['licence_no'],
                          'fuel_type'=>$row['fuel_type'],
                          'storage'=>$row['storage'],
                          'expire_date'=>$expdate,
                          'location'=>$row['location'],
                          'lat'=>$row['lat'],
                          'lng'=>$row['lng'],
                        ];

                    VillageShop::create($arr);
                   
                }
            DB::commit();
        } catch (Exception $e) {
              DB::rollback();
                return redirect()->route('admin.village_shop.index')
                            ->with('error','Something wrong!');
         }
    }
}
