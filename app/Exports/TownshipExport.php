<?php

namespace App\Exports;

use App\Township;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TownshipExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = new Township();
        $query =$query->leftJoin('state_divisions','state_divisions.id', '=', 'townships.sd_id');

        $query =$query->select(
                            'state_divisions.sd_name',
                            'townships.tsh_name_en',
                            'townships.tsh_name_mm',
                        	'townships.tsh_code'                        	
                       );

    	$results = $query->get();
        return $results;  
    }

    public function headings(): array
    {
        return [
            'State/Division',
            'Township Name (Eng)',
            'Township Name (Eng)',
            'Township Code'
        ];
    }

  
}
