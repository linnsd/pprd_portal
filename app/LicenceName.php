<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicenceName extends Model
{
    protected $table = 'licence_names';
    protected $fillable = ['lic_gp_id','lic_sub_gp_id','lic_name'];

    public function viewLicenceGp()
    {
    	return $this->hasOne('App\LicenceGroup','id','lic_gp_id');
    }

    public function viewSubLicenceGp()
    {
    	return $this->hasOne('App\SubLicGroup','id','lic_sub_gp_id');
    }
}
