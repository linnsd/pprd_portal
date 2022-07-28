<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    protected $table = 'terminals';
    protected $fillable = ['company_name','sd_id','tsh_id','location','lic_no','issue_date','gasoline','disel','remark','nrc','comp_licence_no','comp_issue_date'];

    public function statedivision()
    {
    	return $this->hasOne('App\StateDivision','id','sd_id');
    }
    public function township()
    {
    	return $this->hasOne('App\Township','id','tsh_id');
    }
}
