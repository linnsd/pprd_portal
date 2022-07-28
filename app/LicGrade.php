<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicGrade extends Model
{
    protected $table = 'lic_grades';
    protected $fillable = ['lic_name_id','grade'];

    public function viewLicence()
    {
    	return $this->hasOne('App\LicenceName','id','lic_name_id');
    }
}
