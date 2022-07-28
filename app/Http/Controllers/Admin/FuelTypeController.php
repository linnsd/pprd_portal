<?php

namespace App\Http\Controllers\Admin;

use App\FuelType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FuelTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fuel_types = FuelType::list($request);

        $count = $fuel_types->get()->count();

        $fuel_types = $fuel_types->orderBy('fuel_types.created_at','asc')->paginate(10);

        return view('admin.fuel_type.index',compact('fuel_types','count'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fuel_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fuel_type = FuelType::store_data($request);
        return redirect()->route('admin.fuel_types.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FuelType  $fuelType
     * @return \Illuminate\Http\Response
     */
    public function show(FuelType $fuelType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FuelType  $fuelType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fuel_type = FuelType::find($id);
        return view('admin.fuel_type.edit',compact('fuel_type'));
    }

    /** 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FuelType  $fuelType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fuel_type = FuelType::update_data($request,$id);
        return redirect()->route('admin.fuel_types.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FuelType  $fuelType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fuel_type = FuelType::find($id)->delete();
        return redirect()->route('admin.fuel_types.index')->with('success','Success');
    }

    public function change_type_status(Request $request)
    {
        // dd($request->all());
        $fuel_type = FuelType::find($request->fuel_type_id);
        $fuel_type->status = $request->status;

        $fuel_type->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
}
