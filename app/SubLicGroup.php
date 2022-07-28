<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubLicGroup extends Model
{
    protected $table = 'sub_lic_groups';
    protected $fillable = ['lic_gp_id','lic_sub_gp_name'];

    public function viewLicenceGp()
    {
    	return $this->hasOne('App\LicenceGroup','id','lic_gp_id');
    }
}
