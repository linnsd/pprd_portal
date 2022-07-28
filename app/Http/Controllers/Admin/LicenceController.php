<?php

namespace App\Http\Controllers\Admin;

use App\Licence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LicenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $licences = Licence::all();
        $licences = new Licence();
        $count = $licences->count();
        $licences = $licences->orderBy('created_at','DESC')->paginate(10);
        return view('admin.licence.index',compact('licences','count'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.licence.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'licence_name'=>'required',
           'licence_price'=>'required',
           'extend_price'=>'required',
           'expire_price'=>'required',
           'destroy_price'=>'required',
           'change_owner'=>'required',
           'upgrade_storage'=>'required',
           'change_name'=>'required'
        ]);


       
        $arr=[
              'licence_name'=>$request->licence_name,
              'licence_price'=>$request->licence_price,
              'extend_price'=>$request->extend_price,
              'expire_price'=>$request->expire_price,
              'destroy_price'=>$request->destroy_price,
              'change_owner'=>$request->change_owner,
              'upgrade_storage'=>$request->upgrade_storage,
              'change_name'=>$request->change_name
            ];

        $res = Licence::create($arr);

        return redirect()->route('admin.licence.index')->with('success','Data create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Licence  $licence
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $licence = Licence::find($id);

        return view('admin.licence.show',compact('licence'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Licence  $licence
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $licence = Licence::find($id);
        return view('admin.licence.edit',compact('licence'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Licence  $licence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
           'licence_name'=>'required',
           'licence_price'=>'required',
           'extend_price'=>'required',
           'expire_price'=>'required',
           'destroy_price'=>'required',
           'change_owner'=>'required',
           'upgrade_storage'=>'required',
           'change_name'=>'required'
        ]);


       $licence = Licence::findorFail($id);

        $arr=[
              'licence_name'=>$request->licence_name,
              'licence_price'=>$request->licence_price,
              'extend_price'=>$request->extend_price,
              'expire_price'=>$request->expire_price,
              'destroy_price'=>$request->destroy_price,
              'change_owner'=>$request->change_owner,
              'upgrade_storage'=>$request->upgrade_storage,
              'change_name'=>$request->change_name
            ];

        $res = $licence->update($arr);
        return redirect()->route('admin.licence.index')->with('success','Data update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Licence  $licence
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $licence = Licence::find($id)->delete();
        return redirect()->route('admin.licence.index')->with('success','Data delete successfully');
    }
}
