<?php

namespace App\Http\Controllers\Admin;

use App\AirportOil;
use App\StateDivision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AirportOilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $airport_oils = new AirportOil();
        $keyword = $request->keyword;
        $sd_id = $request->sd_id;
        if ($keyword != '') {
            $airport_oils = $airport_oils->where('company_name','like','%'.$keyword.'%');
        }
        if ($sd_id != '') {
            $airport_oils = $airport_oils->where('sd_id',$sd_id);
        }
        $sdivisions = StateDivision::all();
        $count = $airport_oils->get()->count();

      $airport_oils = $airport_oils->orderBy('created_at','asc')->paginate(10);
        return view('admin.airport_oil.index',compact('airport_oils','count','sdivisions'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statedivisions = StateDivision::all();
        return view('admin.airport_oil.create',compact('statedivisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'company_name'=>'required',
            'comp_licence_no'=>'required',
            'sd_id'=>'required',
            'licence_no'=>'required',
            'issue_date'=>'required',
            'capacity'=>'required',
            'location'=>'required',
        ]);
        $airport_oil = AirportOil::create([
            'company_name'=>$request->company_name,
            'nrc'=>$request->nrc,
            'sd_id'=>$request->sd_id,
            'tsh_id'=>$request->tsh_id,
            'comp_lic_no'=>$request->comp_licence_no,
            'licence_no'=>$request->licence_no,
            'comp_issue_date'=>$request->comp_issue_date,
            'issue_date'=>$request->issue_date,
            'capacity'=>$request->capacity,
            'location'=>$request->location,
            'type'=>($request->type)?$request->type:""
        ]);
        return redirect()->route('admin.airport_oil.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AirportOil  $airportOil
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $airport_oil = AirportOil::find($id);
        return view('admin.airport_oil.show',compact('airport_oil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AirportOil  $airportOil
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $statedivisions = StateDivision::all();
        $airport_oil = AirportOil::find($id);
        return view('admin.airport_oil.edit',compact('statedivisions','airport_oil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AirportOil  $airportOil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'company_name'=>'required',
            'sd_id'=>'required',
            'licence_no'=>'required',
            'issue_date'=>'required',
            'comp_issue_date'=>'required',
            'capacity'=>'required',
            'location'=>'required'
        ]);
        $airport_oil = AirportOil::find($id);
        $airport_oil = $airport_oil->update([
            'company_name'=>$request->company_name,
            'nrc'=>$request->nrc,
            'sd_id'=>$request->sd_id,
            'tsh_id'=>$request->tsh_id,
            'comp_lic_no'=>$request->comp_licence_no,
            'licence_no'=>$request->licence_no,
            'comp_issue_date'=>$request->comp_issue_date,
            'issue_date'=>$request->issue_date,
            'capacity'=>$request->capacity,
            'location'=>$request->location,
            'type'=> ($request->type) ? $request->type : ""
        ]);
        return redirect()->route('admin.airport_oil.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AirportOil  $airportOil
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $airport_oil = AirportOil::find($id)->delete();
        return redirect()->route('admin.airport_oil.index')->with('success','Success');
    }
}
