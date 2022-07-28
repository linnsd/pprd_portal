<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportTime extends Model
{
    protected $table = 'report_times';
    protected $fillable = ['rep_time','activ_status','shop_type'];

    public static function list($request)
    {
        $data = new ReportTime();

        if ($request->keyword != null) {
            $data = $data->where('rep_time','like','%'.$request->keyword.'%');
        }

        return $data;
    }

    public static function store_data($request)
    {
        // dd($request->all());
        $data = ReportTime::create([
            'rep_time'=>$request->rep_time,
        ]);

        return $data;
    }

    public static function update_data($request,$id)
    {
        $data = ReportTime::find($id)->update([
            'rep_time'=>$request->rep_time,
        ]);

        return $data;
    }
}
