<?php

namespace App\Exports;

use App\FuelShop;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// for applying style sheet
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
Use \Maatwebsite\Excel\Sheet;

use DB;

class ShopsExport implements  FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function view(): View
    { 
        $sd_id = (!empty($_POST['sd_id']))?$_POST['sd_id']:'';
        $tsh_id = (!empty($_POST['tsh_id']))?$_POST['tsh_id']:'';
       
       	$fuel_shops = new FuelShop();
        $fuel_shops = $fuel_shops->leftjoin('state_divisions','state_divisions.id','=','fuel_shops.sd_id')->leftjoin('townships','townships.id','=','fuel_shops.tsh_id')->leftjoin('licences','licences.id','=','fuel_shops.licence_id')->leftjoin('lic_grades','lic_grades.id','=','fuel_shops.lic_grade');

        
        if ($sd_id != '') {
            $fuel_shops = $fuel_shops->where('fuel_shops.sd_id',$sd_id);
        }

        if ($tsh_id != '') {
            $fuel_shops = $fuel_shops->where('fuel_shops.tsh_id',$tsh_id);
        }

        $fuel_shops =$fuel_shops->select('fuel_shops.id','fuel_shops.shopName','state_divisions.sd_name','townships.tsh_name_mm','fuel_shops.owner','fuel_shops.licence_no','fuel_shops.shop_type','fuel_shops.shop_status','fuel_shops.lic_issue_date','fuel_shops.lic_expire_date','fuel_shops.address','lic_grades.grade')->where('show_status',1)->get();
      
        // dd($fuel_shops);
        
        return view('admin.fuel_shops.export',compact('fuel_shops'));
    }

}