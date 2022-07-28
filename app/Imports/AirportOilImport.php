<?php

namespace App\Imports;

use App\AirportOil;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;
use Hash;

class AirportOilImport implements ToCollection,WithHeadingRow
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
                    $rowisudate= str_replace('/','-',$row['issue_date']);
                    $isudate= date('Y-m-d', strtotime($rowisudate));
       
                    $arr=[
                          'sd_id'=>$row['sd_id'],
                          'company_name'=>$row['company_name'],
                          'location'=>$row['location'],
                          'comp_lic_no'=>$row['company_lic_no'],
                          'comp_issue_date'=>$isudate,
                          'licence_no'=>$row['licence_no'],
                          'issue_date'=>$row['issue_date'],
                          'type'=>$row['type'];
                          'capacity'=>$row['capacity'],
                        ];

                    AirportOil::create($arr);
                   
                }
            DB::commit();
        } catch (Exception $e) {
              DB::rollback();
                return redirect()->route('admin.airport_oil.index')
                            ->with('error','Something wrong!');
         }
    }
}
