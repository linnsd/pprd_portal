<?php

namespace App\Http\Controllers\Admin;

use App\LicenceName;
use App\LicenceGroup;
use App\SubLicGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LicenceNameController extends Controller
{
    //  public function __construct() 
    // {
    //   $this->middleware('permission:licence-list|licence-create|licence-edit|licence-delete', ['only' => ['index','show']]);
    //   $this->middleware('permission:licence-create', ['only' => ['create','store']]);
    //   $this->middleware('permission:licence-edit', ['only' => ['edit','update']]);
    //   $this->middleware('permission:licence-delete', ['only' => ['destroy']]);
    // }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd("Here");
        $licencegps = LicenceGroup::all();
        $sublicgps = SubLicGroup::all();

        $licencenames = new LicenceName();
        $keyword = $request->keyword;
        $lic_gp_id = $request->lic_gp_id;
        $sub_lic_gp_id = $request->sub_lic_gp_id;

        if ($keyword != '') {
            $licencenames = $licencenames->where('lic_name','like','%'.$keyword.'%');
        }

        if ($lic_gp_id != '') {
            $licencenames = $licencenames->where('lic_gp_id',$lic_gp_id);
        }

        if ($sub_lic_gp_id != '') {
            $licencenames = $licencenames->where('lic_sub_gp_id',$sub_lic_gp_id);
        }

        $count = $licencenames->get()->count();

      $licencenames = $licencenames->orderBy('created_at','asc')->paginate(10);
        return view('admin.licencename.index',compact('licencenames','count','licencegps','sublicgps'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $licgroups = LicenceGroup::all();
        $sublicgps = SubLicGroup::all();
        return view('admin.licencename.create',compact('licgroups','sublicgps'));
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
             'lic_name'=>'required'
         ]);

        $sublicgps = LicenceName::create([
            'lic_gp_id'=>$request->lic_gp_id,
            'lic_sub_gp_id'=>$request->sub_lic_id,
            'lic_name'=> $request->lic_name
        ]);
        return redirect()->route('admin.licence_name.index')->with('success','Data create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LicenceName  $licenceName
     * @return \Illuminate\Http\Response
     */
    public function show(LicenceName $licenceName)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LicenceName  $licenceName
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $licencegps = LicenceGroup::all();
        $sublicgps = SubLicGroup::all();
        $licnames = LicenceName::find($id);
        return view('admin.licencename.edit',compact('licencegps','sublicgps','licnames'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LicenceName  $licenceName
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
             'lic_gp_id'=>'required',
             'lic_name'=>'required'
         ]);
        $licnames = LicenceName::find($id);
        $licnames = $licnames->update([
            'lic_gp_id'=>$request->lic_gp_id,
            'lic_sub_gp_id'=>$request->sub_lic_id,
            'lic_name'=> $request->lic_name
        ]);

        return redirect()->route('admin.licence_name.index')->with('success','Data update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LicenceName  $licenceName
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $licname = LicenceName::find($id)->delete();
        return redirect()->route('admin.licence_name.index')->with('success','Data delete successfully');
    }
}
