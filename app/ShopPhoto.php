<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopPhoto extends Model
{
    protected $table = 'shop_photos';
    protected $fillable = ['shop_id','type','photo_name','path','name','show_status'];

    public function shop()
    {
       return $this->hasOne('App\FuelShop','id','shop_id');
    }

    public static function update_shop_photo($param)
    {
        $attach = ShopPhoto::find($param['doc_id']);

        $document_file = ($param['doc_file'] != '') ? $param['doc_file'] : $attach->name;
        $path="uploads/shop_photos/";
        
       if ($file = $param['doc_file']) {
            $document_file = $param['doc_file'];
            $ext = '.'.$param['doc_file']->getClientOriginalExtension();

            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $document_file->getClientOriginalName());
            $file->move($path, $fileName);
            $document_file = $fileName;
            
        }

         $attach = $attach->update([
            'path'=>'uploads/shop_photos/',
            'name'=>$document_file,
            'photo_name'=>$param['f_name'],
         ]);

         return $attach;
    }

    public static function update_lic_photo($param)
    {
       $attach = ShopPhoto::find($param['lic_shop_id']);

        $document_file = ($param['doc_file'] != '') ? $param['doc_file'] : $attach->name;
        $path="uploads/licence_photos/";
        
       if ($file = $param['doc_file']) {
            $document_file = $param['doc_file'];
            $ext = '.'.$param['doc_file']->getClientOriginalExtension();

            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $document_file->getClientOriginalName());
            $file->move($path, $fileName);
            $document_file = $fileName;
            
        }

         $attach = $attach->update([
            'path'=>'uploads/licence_photos/',
            'name'=>$document_file,
            'photo_name'=>$param['lic_name'],
         ]);

         return $attach;
    }
}
