<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = ['path','photo','publish_date','status','title','description'];

    
    public static function list($request)
   {
       $notifications = new Notification();
       return $notifications;
   }   

   public static function store_data($request)
   {
       $date = Carbon::now();
        $timeInMilliseconds = $date->getPreciseTimestamp(3);

        $destinationPath = public_path() . '/uploads/noti_photo/';
        $photo = "";
        // dd($request->all());

        $photo = "";
        if ($file = $request->file('photo')) {
            $photo = $request->file('photo');
            $ext = '.'.$request->photo->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->photo->getClientOriginalName());
            $file->move($destinationPath, $fileName);
            $photo = $fileName;
        }


        $noti = Notification::create([
            'path'=>$request->photo ? '/uploads/noti_photo/' : null,
            'photo'=>$photo,
            'title'=>$request->title,
            'description'=>$request->description,
            'publish_date'=>date('Y-m-d',strtotime($request->publish_date))
        ]);

        return $noti;
   }

   public static function update_data($request,$id)
   {
        $destinationPath = public_path() . '/uploads/noti_photo/';

        $noti = Notification::find($id);

        $noti_photo = ($request->photo != '') ? $request->photo : $noti->photo;
       
        if ($file = $request->file('photo')) {
            $noti_photo = $request->file('photo');
            $ext = '.'.$request->photo->getClientOriginalExtension();

            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $noti_photo->getClientOriginalName());
            $file->move($destinationPath, $fileName);
            $noti_photo = $fileName;
        }

        $noti = $noti->update([
            'path'=>$request->photo ? '/uploads/noti_photo/' : null,
            'photo'=>$noti_photo,
            'title'=>$request->title,
            'description'=>$request->description,
            'publish_date'=>date('Y-m-d',strtotime($request->publish_date))
        ]);

        return $noti;
   }
}
