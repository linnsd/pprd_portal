<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // 
        factory(App\User::class)->create([
            "name" => "Admin",
            "email"=> "admin@pprd.gov.mm"
        ]);


//         factory(App\StateDivision::class)->create(
//             [
//                 'id'=>1,
//                 'sd_name'=>"နေပြည်တော်",
//                 'sd_short'=>"NPW",
//                 'sd_color'=>"#55FF57",
//             ],
//             [
//                 'id'=>2,
//                 'sd_name'=>"ရန်ကုန်",
//                 'sd_short'=>"YGN",
//                 'sd_color'=>"#40E5F9",
//             ],
//             [
//                 'id'=>3,
//                 'sd_name'=>"မန္တလေး",
//                 'sd_short'=>"MDY",
//                 'sd_color'=>"#4a8dbc",
//             ],
//         );

//         factory(App\Shops::class)->create(
//             [
//                 'id'=>1,
//                 'sd_id'=>1,
//                 'shop_name'=>"မြဝတီ",
//                 'owner'=>"ပြည်ထောင်စုမြန်မာနိုင်ငံစီးပွားရေး ဦးပိုင်လီမိတက်(မြဝတီထရေးဒင်း
// ကုမ္ပဏီလီမိတက်)",
//                 'licence_no'=>"0009",
//                 'fuel_type'=>'ဓါတ်ဆီ/ဒီဇယ်',
//                 'storage'=>'25600',
//                 'expire_date'=>'2021-01-20',
//                 'location'=>'(၀၃၅၃)၊ အကွက်အမှတ်(စီ-၃)၊ ပျဉ်းမနား-တောင်ညိုလမ်း၊ ပညာသိဒ္ဓိရပ်ကွက်၊ ဇမ္ဗူသီရိမြို့နယ်'
//             ],
//             [
//                 'id'=>2,
//                 'sd_id'=>1,
//                 'shop_name'=>"New Day ",
//                 'owner'=>"New Day Energy Co., Ltd.",
//                 'licence_no'=>"0021",
//                 'fuel_type'=>'ဓါတ်ဆီ/ဒီဇယ်',
//                 'storage'=>'19200',
//                 'expire_date'=>'2020-11-06',
//                 'location'=>'(၀၃၅၁)၊ သက်ကယ်ကျင်းကျေးရွာ၊ ရန်ကုန်-မန္တလေး
// လမ်းဟောင်း၊ ပျဉ်းမနားမြို့'
//             ],
//             [
//                 'id'=>3,
//                 'sd_id'=>1,
//                 'shop_name'=>"DENKO",
//                 'owner'=>"Eden Group Co., Ltd. (Denko)",
//                 'licence_no'=>"0054",
//                 'fuel_type'=>'ဓါတ်ဆီ/ဒီဇယ်',
//                 'storage'=>'18800',
//                 'expire_date'=>'2020-11-04',
//                 'location'=>'(၀၃၇၃)၊ ရန်ကုန်-မန္တလေးလမ်းဟောင်း၊ တပ်ကုန်းမြို့'
//             ],
//         );


       
    }
}
