<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;

class SettingController extends Controller
{
    public function siteSetting(Request $request)
    {   
        $setting = Setting::first();
        return view('admin.setting.index',compact('setting'));   
    }

    public function generateApiKey()
    {
        $n=10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
    
        for ($i = 0; $i < $n; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 

        $key = sha1(md5( $randomString));

        $data = Setting::first();

        // $request->validate([
        //     'site_tile'=>'required',
        //     'site_description'=>'required',
        //     'api_key'=>'required'
        //  ]);
 
       
       
         $arr=[
            //    'site_tile'=>$request->site_tile,
            //    'site_description'=>$request->site_description,
               'api_key'=>$key
             ];
 
 
         $data->fill($arr)->save();
      return redirect()->route('admin.site.setting')->with('success','New API Key generate successfully');
    }

    public function updateSetting(Request $request)
    {
        

        $data = Setting::first();

        $request->validate([
            'site_tile'=>'required',
            'site_description'=>'required',
            'api_key'=>'required'
         ]);
 
       
       
         $arr=[
               'site_tile'=>$request->site_tile,
               'site_description'=>$request->site_description,
               'api_key'=>$request->api_key
             ];
 
 
         $data->fill($arr)->save();
      return redirect()->route('admin.site.setting')->with('success','Update successfully');
    }
}
