<?php

namespace App\Exports;

use App\Car;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CarExport implements  FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = new Car();
        $query = $query->leftjoin('drivers','drivers.id','=','cars.driver_id')
                       ->leftjoin('state_divisions','state_divisions.id','=','cars.sd_id');
        $query =$query->select(
                          'no',
                          'company_name',
                           'sd_name',
                           'plate_no',
                           'dname',
			               'model',
			               'type',
			               'capacity',
			               'weight',
			               'power',
                           'issue_date',
			               'expire_date',
			               'eng_no',
			               'chassis_no',
                           'oil_carry_back',
                           'mine_no',
                           'address'
                       );

      $state_division_id = (!empty($_POST['state_division_id']))?$_POST['state_division_id']:'';

      if($state_division_id){
          $query = $query->where('cars.sd_id',$state_division_id);
      }


    	$results = $query->get();
        return $results;
    }

    public function headings(): array
    {
        return [
            "No",
            "ကုမ္ပဏီ/ပိုင်ရှင်အမည်",
            "တိုင်းဒေသကြီးအမည်",
            'ယာဉ်အမှတ်',
            'ယာဉ်မောင်း',
            'ထုတ်လုပ်သည့်ကုမ္ပဏီ/မော်ဒယ်',
            'ယာဉ်အမျိုးအစား',
            'တင်ဆောင်နိုင်သည့်ပမာဏ',
            'ယာဉ်အလေးချိန်',
			'အင်ဂျင်ပါဝါ',
            'ထုတ်ပေးသည့်ရက်',
			'သက်တမ်းကုန်ဆုံးရက်',
			'စက်အမှတ်',
		    'ဘောင်အမှတ်',
            'ဆီသယ်နောက်တွဲယာဉ်',
            'သတ္တုတွင်းခွင့်ပြုမိန့်အမှတ်',
            "လိပ်စာ"

        ];
    }
}
