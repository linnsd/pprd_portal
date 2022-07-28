<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StateDivision;

class StateDivisionController extends Controller
{
    public function __construct()
    {
     

        // $this->middleware('permission: states-divisions-list| state-division-create| state-division-edit| state-division-delete', ['only' => ['index','show']]);
        // $this->middleware('permission: state-division-create', ['only' => ['create','store']]);
        // $this->middleware('permission: state-division-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission: state-division-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $data = new StateDivision();

      $keyword = $request->keyword;
     
      if($keyword!=''){
        $data = $data->where('sd_name','like','%'.$keyword.'%');
      }

      $count = $data->get()->count();

      $data = $data->orderBy('mmr_code','asc')->paginate(20);

      return view('admin.state_division.index',compact('data','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.state_division.create');
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
           'sd_name'=>'required',
           'sd_short'=>'required',
           'sd_color'=>'required',
           'mmr_code'=>'required'
        ]);


       
        $arr=[
              'sd_name'=>$request->sd_name,
              'sd_short'=>$request->sd_short,
              'mmr_code'=>$request->mmr_code,
              'sd_color'=>$request->sd_color
            ];

        $res=StateDivision::create($arr);

        return redirect()->route('admin.states-divisons.index')->with('success','Data create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = StateDivision::find($id);
        return view('admin.state_division.show',compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = StateDivision::find($id);
        return view('admin.state_division.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $data = StateDivision::findOrFail($id);

       $request->validate([
           'sd_name'=>'required',
           'sd_short'=>'required',
           'sd_color'=>'required',
           'mmr_code'=>'required'
        ]);

      
      
        $arr=[
              'sd_name'=>$request->sd_name,
              'sd_short'=>$request->sd_short,
              'mmr_code'=>$request->mmr_code,
              'sd_color'=>$request->sd_color
            ];


        $data->fill($arr)->save();


        return redirect()->route('admin.states-divisons.index')->with('success','Data Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $data = StateDivision::find($id)->delete();
      return redirect()->back()->with('success','Deleted!');

    }

  
}
