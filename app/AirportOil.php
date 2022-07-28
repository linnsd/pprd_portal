<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AirportOil extends Model
{
    protected $table = 'airport_oil';
    protected $fillable = ['company_name','sd_id','location','comp_lic_no','comp_issue_date','licence_no','issue_date','type','capacity'];

    public function state_division()
    {
    	return $this->hasOne('App\StateDivision','id','sd_id');
    }
}
