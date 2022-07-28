<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class StateDivision extends Model
{
    use LogsActivity;

    protected static $logFillable = true;
    protected static $logName = 'state divisions';
    protected static $recordEvents = ['created','updated','deleted'];


    public function getDescriptionForEvent(string $eventName):string
    {
        $user = auth()->user()->name;
       return "{$user} have {$eventName} State/Divisions";
    }

    protected $table = 'state_divisions';
    protected $fillable = [
     	 		     		'sd_name',
				            'sd_short',
                            'mmr_code',
				            'sd_color',
				     	];

	public function townships()
    {
    	return $this->hasMany('App\Township','sd_id');
    }

    public function cars()
    {
        return $this->hasMany('App\Car','sd_id');
    }
}
