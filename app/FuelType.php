<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FuelType extends Model
{
    protected $table = 'fuel_types';
    protected $fillable = ['fuel_type','status'];

    public static function list($request)
    {
        $fuel_types = new FuelType();

        if ($request->keyword != null) {
            $fuel_types = $fuel_types->where('fuel_type','like','%'.$request->keyword.'%');
        }

        return $fuel_types;
    }

    public static function store_data($request)
    {
        $data = FuelType::create([
            'fuel_type'=>$request->fuel_type,
        ]);

        return $data;
    }

    public static function update_data($request,$id)
    {
        $data = FuelType::find($id)->update([
            'fuel_type'=>$request->fuel_type
        ]);

        return $data;
    }
}
