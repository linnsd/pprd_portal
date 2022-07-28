<?php

namespace App\Http\Controllers\Admin;

use App\SubLicGroup;
use App\LicenceGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubLicGroupController extends Controller
{
    // public function __construct() 
    // {
    //   $this->middleware('permission:licence-sub-list|licence-sub-create|licence-sub-edit|licence-sub-delete', ['only' => ['index','show']]);
    //   $this->middleware('permission:licence-sub-create', ['only' => ['create','store']]);
    //   $this->middleware('permission:licence-sub-edit', ['only' => ['edit','update']]);
    //   $this->middleware('permission:licence-sub-delete', ['only' => ['destroy']]);
    // }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $licencegps = LicenceGroup::all();
        $sublicgps = new SubLicGroup();
        $keyword = $request->keyword;
        $lic_gp_id = $request->lic_gp_id;
        if ($keyword != '') {
            $sublicgps = $sublicgps->where('lic_gp_name','like','%'.$keyword.'%');
        }

        if ($lic_gp_id != '') {
            $sublicgps = $sublicgps->where('lic_gp_id',$lic_gp_id);
        }

        $count = $sublicgps->get()->count();

      $sublicgps = $sublicgps->orderBy('created_at','asc')->paginate(10);
        return view('admin.sublicgp.index',compact('sublicgps','count','licencegps'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $licencegps = LicenceGroup::all();
        return view('admin.sublicgp.create',compact('licencegps'));
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
             'lic_gp_id'=>'required',
             'lic_sub_gp_name'=>'required'
         ]);

        $sublicgps = SubLicGroup::create([
            'lic_gp_id'=>$request->lic_gp_id,
            'lic_sub_gp_name'=>$request->lic_sub_gp_name
        ]);
        return redirect()->route('admin.sub_lic_gp.index')->with('success','Data create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubLicGroup  $subLicGroup
     * @return \Illuminate\Http\Response
     */
    public function show(SubLicGroup $subLicGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubLicGroup  $subLicGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $licencegps = LicenceGroup::all();
        $sublicgps = SubLicGroup::find($id);
        return view('admin.sublicgp.edit',compact('licencegps','sublicgps'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubLicGroup  $subLicGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
             'lic_gp_id'=>'required',
             'lic_sub_gp_name'=>'required'
         ]);
        $sublicgps = SubLicGroup::find($id);
        $sublicgps = $sublicgps->update([
            'lic_gp_id'=>$request->lic_gp_id,
            'lic_sub_gp_name'=>$request->lic_sub_gp_name
        ]);
        return redirect()->route('admin.sub_lic_gp.index')->with('success','Data update successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubLicGroup  $subLicGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sublicgp = SubLicGroup::find($id)->delete();
        return redirect()->route('admin.sub_lic_gp.index')->with('success','Data delete successfully'); 
    }
}
