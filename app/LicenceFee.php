<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicenceFee extends Model
{
    protected $table = 'licence_fees';
    protected $fillable = ['lic_name_id','lic_grade_id','lic_key','lic_fee_val'];

    public function viewLicenceName()
    {
    	return $this->hasOne('App\LicenceName','id','lic_name_id');
    }

    public function viewLicenceGrade()
    {
    	return $this->hasOne('App\LicGrade','id','lic_grade_id');
    }
}
