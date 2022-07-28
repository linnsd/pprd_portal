<?php

namespace App\Imports;

use App\FuelShop;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;
use Hash;
use App\StateDivision;
use App\Township;
use App\LicenceGroup;
use App\LicGrade;
use App\ShopFuelCapacity;
use App\FuelType;

class ShopsImport implements ToCollection,WithHeadingRow
{
    // use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
     public function collection(Collection $rows)
    {

        DB::beginTransaction();
        try {
                // dd($rows);
                foreach ($rows as $row) 
                { 
                    // dd($row['ms']);
                    $rowexpdate= str_replace('/','-',$row['expire_date']);
                    $expdate= date('Y-m-d', strtotime($rowexpdate));

                   

                    $state_divisions = StateDivision::all();
                        foreach ($state_divisions as $key => $value) {
                           if ($row['state_division'] == $value->sd_short) {
                               $sd_id = $value->id;
                           }
                        }

                    $tsh_id = null;
                    if ($row['township'] != null) {
                        $townships = Township::all();
                        foreach ($townships as $key => $value) {
                           if ($row['township'] == $value->tsh_name_en) {
                               $tsh_id = $value->id;
                           }
                        }
                    }
                    

                    $licence_id = null;
                    if ($row['licence_name'] != null) {
                        $licences = LicenceGroup::all();
                        foreach ($licences as $key => $value) {
                           if ($row['licence_name'] == $value->lic_gp_name) {
                               $licence_id = $value->id;
                           }
                        }

                    }
                    
                    $lic_grades = LicGrade::all();
                    foreach ($lic_grades as $key => $value) {
                        if ($row['grade'] == $value->grade) {
                               $licence_grade_id = $value->id;
                           }
                    }



                    $user = User::create([
                                'role_id'=>5,
                                'status'=>1,
                                'sd_id'=>$sd_id,
                                'loginId'=>$row['licence_no'],
                                'name'=>$row['shop_name'],
                                'password'=>Hash::make(123456),

                            ]);
                        $user->assignRole("Shop Owner");

                        $shop_fuel = [
                            'sd_id'=>$sd_id,
                            'tsh_id'=>$tsh_id,
                            'lic_grade'=>$licence_grade_id,
                            'shopName'=>$row['shop_name'],
                            'owner'=>$row['owner'],
                            'address'=>$row['address'],
                            
                            'licence_id'=>$licence_id,
                            'licence_no'=>$row['licence_no'],
                            'shop_type'=>$row['shop_type'] == "Major" ? 1 : 0,
                            'shop_status'=>1,
                            'lic_issue_date'=>date('Y-m-d',strtotime($row['issue_date'])),
                            'lic_expire_date'=>date('Y-m-d',strtotime($row['expire_date'])),
                            'remark'=>$row['remark'],
                    ];
                    $shop = FuelShop::create($shop_fuel);

                    // $fuel_types = FuelType::where('status',1)->get();
                    // foreach ($fuel_types as $key => $value) {
                    //     if ($row['fuel_type'] == $value->fuel_type) {
                    //            $fuel_type_id = $value->id;
                    //        }
                    // }

                    $fuel = ShopFuelCapacity::create([
                        'shop_id'=>$shop->id,
                        'fuel_type'=>6,
                        'max_capacity'=>$row['ms']
                    ]);

                    $fuel = ShopFuelCapacity::create([
                        'shop_id'=>$shop->id,
                        'fuel_type'=>5,
                        'max_capacity'=>$row['pd']
                    ]);

                    $fuel = ShopFuelCapacity::create([
                        'shop_id'=>$shop->id,
                        'fuel_type'=>4,
                        'max_capacity'=>$row['hsd']
                    ]);

                    $fuel = ShopFuelCapacity::create([
                        'shop_id'=>$shop->id,
                        'fuel_type'=>3,
                        'max_capacity'=>$row['97_ron']
                    ]);

                    $fuel = ShopFuelCapacity::create([
                        'shop_id'=>$shop->id,
                        'fuel_type'=>2,
                        'max_capacity'=>$row['95_ron']
                    ]);

                    $fuel = ShopFuelCapacity::create([
                        'shop_id'=>$shop->id,
                        'fuel_type'=>1,
                        'max_capacity'=>$row['92_ron']
                    ]);
                }
            DB::commit();
        } catch (Exception $e) {
              DB::rollback();
                return redirect()->route('admin.fuel_shops.index')
                            ->with('error','Something wrong!');
         }
    }
}
