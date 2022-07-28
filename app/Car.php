<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Car extends Model
{ 
    use LogsActivity;

    protected static $logFillable = true;
    protected static $logName = 'vehicle';
    protected static $recordEvents = ['created','updated','deleted'];


    public function getDescriptionForEvent(string $eventName):string
    {
        $user = auth()->user()->name;
       return "{$user} have {$eventName} vehicle";
    }

     protected $table = 'cars';
     protected $fillable = [
               'car_type',
               'no',
               'sd_id',
               'car_prefix_no',
               'car_prefix_character',
               'car_no',
               'plate_no',
               'driver_id',
               'model',
               'type',
               'fuel_type',
               'capacity',
               'unit_id',
               'mine_no',
               'oil_carry',
               'oil_carry_back',
               // 'wheels',
               'weight',
               'power',
               'issue_date',
               'expire_date',
               'eng_no',
               'chassis_no',
               // 'color',

               'owner_book_photo',
               'licence_photo_f',
               'licence_photo_b',
               'photo1',

               'car_f_photo',
               'car_b_photo',
               'eng_photo',
               'head_room_photo',
               'ka_nya_na_photo',
               'mine_licence_photo',
               'path',

              'company_name',
              'fuel_type',
              'address',
              'locked',
              'user_id',
              'addedBy'
     ];

    public function photos()
    {
        return $this->hasMany('App\CarPhoto','id','car_id');
    }

    public function drivers()
    {
        return $this->hasMany('App\Driver','id','driver_id');
    }

    public function statedivisions()
    {
        return $this->hasOne('App\StateDivision','id','sd_id');
    }
}
