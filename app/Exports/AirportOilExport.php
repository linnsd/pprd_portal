<?php

namespace App\Exports;

use App\AirportOil;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AirportOilExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = new AirportOil();
        $query = $query->leftjoin('state_divisions','state_divisions.id','=','airport_oil.sd_id')
        			->select(
						
						'company_name',
            'sd_name',
						'location',
            'comp_lic_no',
            'comp_issue_date',
						'licence_no',
						'issue_date',
						'capacity',
						'type',
                    );
      //  $fuel_id = (!empty($_POST['fuel_id']))?$_POST['fuel_id']:'';
      //  $licence_id = (!empty($_POST['licence_id']))?$_POST['licence_id']:'';
      //  // dd($licence_id);

      // if($fuel_id){
      //     $query = $query->where('shops.fuel_type',$fuel_id);
      // }
      // if ($licence_id) {
      // 	$query = $query->where('shops.licence_id',$licence_id);
      // }

    	$results = $query->get();
        return $results;
    }
 
    public function headings(): array
    {
        return [
        'Company Nmae',
  			'State/Division',
  			'location',
  			'Company Licence NO',
  			'Issue Date',
  			'Licence no',
  			'issue_date',
  			'Capacity',
        'Type'
        ];
    }
}
