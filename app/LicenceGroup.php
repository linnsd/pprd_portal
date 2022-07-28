<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LicenceGroup extends Model
{
    protected $table = 'licence_groups';
    protected $fillable = ['lic_gp_name','prefix_code'];
}
