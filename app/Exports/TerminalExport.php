<?php

namespace App\Exports;

use App\Terminal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TerminalExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = new Terminal();
        $query = $query->leftjoin('state_divisions','state_divisions.id','=','terminals.sd_id')
        			->leftjoin('townships','townships.id','=','terminals.tsh_id')
        			->select(
						
						'company_name',
            'sd_name',
            'tsh_name_mm',
						'location',
						'lic_no',
						'issue_date',
						'gasoline',
						'disel',
						'remark'
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
			'Township',
			'location',
			'Licence NO',
			'Issue Date',
			'Gasoline',
			'Disel',
			'Remark'
        ];
    }
}
