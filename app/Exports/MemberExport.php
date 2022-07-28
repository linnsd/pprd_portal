<?php

namespace App\Exports;

use App\RegisterUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MemberExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $query = new RegisterUser();
        $query =$query->leftJoin('state_divisions','state_divisions.id', '=', 'register_users.state_division_id');

        $state_division_id = (!empty($_GET["state_division_id"])) ? ($_GET["state_division_id"]) : ('');
        $status = (!empty($_GET["status"])) ? ($_GET["status"]) : ('');


        if($state_division_id){
            $query = $query->where('register_users.state_division_id',$state_division_id);
        }

        if($status){
            $query = $query->where('register_users.status',$status);
        }

        $query =$query->select(
                            'register_users.id',
                            'register_users.status',
                            'register_users.approve_date',
                        	'register_users.name',
				            'register_users.email',
				            'register_users.nrc',
				            'register_users.phone',
				            'register_users.address',
				            'register_users.business_name',
				            'state_divisions.sd_name',
				            'register_users.township',
				            'register_users.created_at'
                        	
                       );

    	$results = $query->get();
        return $results;     
    }

    public function headings(): array
    {
        return [
            'Member ID',
            'Status',
            'Approve date',
            'အမည္',
            'Email',
			'မွတ္ပံုတင္အမွတ္',
			'ဖုန္းနံပါတ္ ',
			'ေနရပ္လိပ္စာ',
		    'ဆိုင္အမည္/ကုမၸဏီအမည္',
			'ျပည္နယ္/တို္င္း',
			'ျမိဳ႔နယ္',
			'စာရင္းသြင္းသည့္ေန့'
			
        ];
    }
}
