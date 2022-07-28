<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VillageShop extends Model
{
    // use LogsActivity;

    protected static $logFillable = true;
    protected static $logName = 'village_shops';
    protected static $recordEvents = ['created','updated','deleted'];


    public function getDescriptionForEvent(string $eventName):string
    {
        $user = auth()->user()->name;
       return "{$user} have {$eventName} Shop";
    }

     protected $table = 'village_shops';
     protected $fillable = [
     			  'user_id',
     	 		  'sd_id',
     	 		  'tsh_id',
                  'licence_id',
            'shop_name',
            'company_no',
            'grade_id',
            'owner',
            'licence_no',
            'fuel_type',
            'gasoline',
            'diesel',
            'storage',
            'issue_date',
            'expire_date',
            'location',
            'lat',
            'lng',
            'photo1',
            'photo2',
            'photo3',
            'photo4',
            'photo5',
            'photo6',
            'photo7',
            'photo8',
            'photo9',
            'photo10',
            'path'
     ];

     public function statedivsion()
     {
     	return $this->hasOne("App\StateDivision",'id','sd_id');
     }

     public function grade()
     {
        return $this->hasOne("App\LicGrade",'id','grade_id');
     }

     public function township()
     {
        return $this->hasOne("App\Township",'id','tsh_id');
     }

     public function licence()
     {
        return $this->hasOne("App\LicenceName",'id','licence_id');
     }

     public function user()
     {
     	return $this->hasOne("App\User",'id','user_id');
     }
}
