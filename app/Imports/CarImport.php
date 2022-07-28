<?php

namespace App\Imports;

use App\Car;
use App\Driver;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;

class CarImport implements  ToCollection,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     $rowexpdate= str_replace('/','-',$row['expire_date']);
    //     $expdate= date('Y-m-d', strtotime($rowexpdate));
    //     return new Car([
    //         'sd_id'=>$row['sd_id'],
    //         'plate_no'=>$row['plate_no'],
    //         'model'=>$row['model'],
    //         'type'=>$row['type'],
    //         'fuel_type'=>$row['fuel_type'],
    //         'capacity'=>$row['capacity'],
    //         // 'wheels'=>$row['wheels'],
    //         'weight'=>$row['weight'],
    //         'power'=>$row['power'],
    //         'expire_date'=>$expdate,
    //         'eng_no'=>$row['eng_no'],
    //         'chassis_no'=>$row['chassis_no'],
    //     ]);
    // }
    // 
    
    public function collection(Collection $rows)
    {



        DB::beginTransaction();
        try {

                foreach ($rows as $row) 
                {

                    $rowissudate= str_replace('/','-',$row['issue_date']);
                    $issudate= date('Y-m-d', strtotime($rowissudate));

                    $rowexpdate= str_replace('/','-',$row['expire_date']);
                    $expdate= date('Y-m-d', strtotime($rowexpdate));

                    $driver = Driver::create([
                        'dname' => $row['driver'],
                    ]);

   
                    $res = Car::create([
                        "sd_id" => (int)$row['sd_id'],
                        "plate_no" => $row['plate_no'],
                        "driver_id" => $driver->id,
                        "model" => $row['model'],
                        "type" => $row['type'],
                        "fuel_type" => $row['fuel_type'],
                        "capacity" =>$row['capacity'],
                        "unit_id" => (int)$row['unit'],
                        "weight" => $row['weight'],
                        "power" => $row['power'],
                        "issue_date" => $issudate,
                        "expire_date" => $expdate,
                        "eng_no" => $row['eng_no'],
                        "chassis_no" => $row['chassis_no'],
                        "mine_no" => $row['mine_no'],
                        "oil_carry_back" => $row['oil_carry_back']
                    ]);
                }
            DB::commit();

            $message = "Something went wrong!";
            return $error;
        } catch (Exception $e) {

            DB::rollback();
            $error = "Something went wrong!";
            return $error;
        }


    }
}
