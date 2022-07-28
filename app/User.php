<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyawnaingtun\Tounicode\TounicodeTrait;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;
    use TounicodeTrait;
    use HasRoles;
    use LogsActivity;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'role_id',
            'status',
            'sd_id',
            'name',
            'email',
            'loginId',
            'password'
    ];

    protected static $logAttributes = ['role_id','sd_id','name','email','loginId'];
    protected static $ignoreChangedAttributes = ['password','updated_at'];
    protected static $recordEvents = ['created','updated'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'user';



    public function getDescriptionForEvent(string $eventName):string
    {
       return "You have {$eventName} user";
    }

     /**
     * These are the attributes to convert before saving.
     * To covert automatically from Non-Unicode to Unicode fonts
     * @var array
     */
    protected $convertable = [
           
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function shop()
    {
        return $this->hasOne('App\StateDivision','id','state_division_id');
    }

    public function statedivision()
    {
        return $this->hasOne('App\StateDivision','id','sd_id');
    }


}
