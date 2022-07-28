<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Township extends Model
{
    use LogsActivity;

     protected $table = 'townships';
     protected $fillable = [
     	 		     		'sd_id',
				            'tsh_name_en',
				            'tsh_name_mm',
				            'tsh_code',
				            'tsh_color'
				     	];

    protected static $logFillable = true;
    protected static $logName = 'township';
    protected static $recordEvents = ['created','updated','deleted'];


    public function getDescriptionForEvent(string $eventName):string
    {
        $user = auth()->user()->name;
       return "{$user} have {$eventName} township";
    }
	 public function statedivsion()
     {
     	return $this->hasOne("App\StateDivision",'id','sd_id');
     }

    public function shops()
    {
    	return $this->hasMany('App\Shops','tsh_id');
    }
}
