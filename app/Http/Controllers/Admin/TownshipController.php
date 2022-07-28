<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Township;
use App\StateDivision;
use Spatie\Activitylog\Models\Activity;

class TownshipController extends Controller
{

    public function __construct()
    {
        // $this->middleware('permission:township-list|township-create|township-edit|township-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:township-create', ['only' => ['create','store']]);
        // $this->middleware('permission:township-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:township-delete', ['only' => ['destroy']]);
        
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stdivisions = StateDivision::all();
        
        $townships =new Township();

        if($request->sd_id!=''){
            $townships = $townships->where('sd_id',$request->sd_id);
        }else{
            $townships = $townships->where('sd_id',1);
        }

        if($request->keyword!=''){
            $townships = $townships->where('tsh_name_en','like','%'.$request->keyword.'%')->orWhere('tsh_name_mm','like','%'.$request->keyword.'%');
        }

        $total = $townships->get()->count();

        $townships = $townships->orderBy('id','desc')->paginate(10);
  
        return view('admin.township.index',compact('townships','stdivisions','total'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $stdivisions = StateDivision::all();
        return view('admin.township.create',compact('stdivisions'));
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
            'sd_id'=>'required',
            'tsh_name_en' => 'required',
            'tsh_name_mm'=>'required',
            'tsh_code' => 'required',
            'tsh_color'=>'required',
        ]);
  
        Township::create($request->all());
   
        return redirect()->route('admin.township.index')
                        ->with('success','Township created successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Township  $township
     * @return \Illuminate\Http\Response
     */
    public function show(Township $township)
    {   
        $townships = Township::get();
        return view('admin.township.show',compact('township','townships'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Township  $township
     * @return \Illuminate\Http\Response
     */
    public function edit(Township $township)
    {   
        $stdivisions = StateDivision::all();
        return view('admin.township.edit',compact('township','stdivisions'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Township  $township
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Township $township)
    {
        $request->validate([
            'sd_id'=>'required',
            'tsh_name_en' => 'required',
            'tsh_name_mm'=>'required',
            'tsh_code' => 'required',
            'tsh_color'=>'required',
        ]);
  
        $township->update($request->all());
  
        return redirect()->route('admin.township.index')
                        ->with('success','Township updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Township  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Township $township)
    {
        $township->delete();
  
        return redirect()->route('admin.township.index')
                        ->with('success','Township deleted successfully');
    }
}
