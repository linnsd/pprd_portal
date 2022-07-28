<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Setting extends Model
{
    use LogsActivity;

    protected static $logFillable = true;
    protected static $logName = 'site-setting';
    protected static $recordEvents = ['created','updated','deleted'];


    public function getDescriptionForEvent(string $eventName):string
    {
        $user = auth()->user()->name;
       return "{$user} have {$eventName} vehicle";
    }

     protected $table = 'settings';
     protected $fillable = ['site_tile','site_description','api_key'];
}
