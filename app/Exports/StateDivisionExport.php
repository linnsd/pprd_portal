<?php

namespace App\Exports;

use App\StateDivision;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StateDivisionExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = new StateDivision();
        $query =$query->select(
                            'sd_name',
				            'sd_short'
                       );

    	$results = $query->get();
        return $results;
    }

    public function headings(): array
    {
        return [
            'State/Division',
            'Short Code'
        ];
    }
}
