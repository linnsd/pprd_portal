<?php

namespace App\Http\Controllers\Admin;

use App\LicenceGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LicenceGroupController extends Controller
{
    // public function __construct() 
    // {
    //   $this->middleware('permission:licence-group-list|licence-group-create|licence-group-edit|licence-group-delete', ['only' => ['index','show']]);
    //   $this->middleware('permission:licence-group-create', ['only' => ['create','store']]);
    //   $this->middleware('permission:licence-group-edit', ['only' => ['edit','update']]);
    //   $this->middleware('permission:licence-group-delete', ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $licencegps = new LicenceGroup();
        $keyword = $request->keyword;

        if($keyword!=''){
        $licencegps = $licencegps->where('lic_gp_name','like','%'.$keyword.'%');
      }

      $count = $licencegps->get()->count();

      $licencegps = $licencegps->orderBy('created_at','asc')->paginate(10);
        return view('admin.licencegp.index',compact('licencegps','count'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.licencegp.create');
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
             'licence_gp_name'=>'required',
             'prefix_code'=>'required'
         ]);

        $licencegp = LicenceGroup::create([
            'lic_gp_name'=>$request->licence_gp_name,
            'prefix_code'=>$request->prefix_code
        ]);

        return redirect()->route('admin.licence_gp.index')->with('success','Data create successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LicenceGroup  $licenceGroup
     * @return \Illuminate\Http\Response
     */
    public function show(LicenceGroup $licenceGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LicenceGroup  $licenceGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $licencegp = LicenceGroup::find($id);
        return view('admin.licencegp.edit',compact('licencegp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LicenceGroup  $licenceGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
             'licence_gp_name'=>'required',
             'prefix_code'=>'required'
         ]);
        $licencegp = LicenceGroup::find($id);
        $licencegp = $licencegp->update(['lic_gp_name'=>$request->licence_gp_name,'prefix_code'=>$request->prefix_code]);
        return redirect()->route('admin.licence_gp.index')->with('success','Data update successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LicenceGroup  $licenceGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $licencegp = LicenceGroup::find($id)->delete();
        return redirect()->route('admin.licence_gp.index')->with('success','Data delete successfully'); 
    }
}
