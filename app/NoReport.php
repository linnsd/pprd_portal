<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoReport extends Model
{
    protected $table = 'no_reports';
    protected $fillable = ['shop_id'];
}
