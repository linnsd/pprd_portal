<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Driver extends Model
{
	use LogsActivity;

    protected static $logFillable = true;
    protected static $logName = 'drivers';
    protected static $recordEvents = ['created','updated','deleted'];


    public function getDescriptionForEvent(string $eventName):string
    {
        $user = auth()->user()->name;
       return "{$user} have {$eventName} drivers";
    }

    protected $table = 'drivers';
    protected $fillable = ['dname'];
}
