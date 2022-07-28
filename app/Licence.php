<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    protected $table = 'licences';
    protected $fillable = ['licence_name','licence_price','extend_price','expire_price','destroy_price','change_owner','upgrade_storage','change_name'];
}
