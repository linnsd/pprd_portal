<?php

namespace App\Http\Controllers\Admin;

use App\LicenceFee;
use App\LicenceName;
use App\LicGrade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LicenceFeeController extends Controller
{
    // public function __construct() 
    // {
    //   $this->middleware('permission:licence-fee-list|licence-fee-create|licence-fee-edit|licence-fee-delete', ['only' => ['index','show']]);
    //   $this->middleware('permission:licence-fee-create', ['only' => ['create','store']]);
    //   $this->middleware('permission:licence-fee-edit', ['only' => ['edit','update']]);
    //   $this->middleware('permission:licence-fee-delete', ['only' => ['destroy']]);
    // }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $licencefees = new LicenceFee();
        $keyword = $request->keyword;
        $lic_name = $request->itemName;

        if($keyword!=''){
        $licencefees = $licencefees->where('lic_key','like','%'.$keyword.'%')->orwhere('lic_fee_val','like','%'.$keyword.'%');
      }

      if ($lic_name != '') {
          $licencefees = $licencefees->where('lic_name_id',$lic_name);
      }

     $count = $licencefees->get()->count();

      $licencefees = $licencefees->orderBy('created_at','asc')->paginate(10);

        return view('admin.licencefee.index',compact('licencefees','count'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lic_grades = LicGrade::all();

        return view('admin.licencefee.create',compact('lic_grades'));
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
             'itemName'=>'required',
             'lic_key'=>'required',
             'lic_value'=>'required',
             'lic_grade_id'=>'required'
         ]);

        foreach ($request->lic_key as $key => $lic_key) {
            $licencefee = LicenceFee::create([
                    'lic_name_id' => $request->itemName,
                    'lic_grade_id'=>$request->lic_grade_id,
                    'lic_key' => $lic_key,
                    'lic_fee_val'=>$request->lic_value[$key],
                ]);
        }

        return redirect()->route('admin.licence_fee.index')->with('success','Data create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LicenceFee  $licenceFee
     * @return \Illuminate\Http\Response
     */
    public function show(LicenceFee $licenceFee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LicenceFee  $licenceFee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd("Here");
        $licencefee = LicenceFee::find($id);
        // dd($licencefee);
        $lic_grades = LicGrade::where('lic_name_id',$licencefee->lic_name_id)->get();
        // dd($lic_grades);
        return view('admin.licencefee.edit',compact('licencefee','lic_grades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LicenceFee  $licenceFee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
             'itemName'=>'required',
             'lic_key'=>'required',
             'lic_value'=>'required'
         ]);

        $licencefee = LicenceFee::find($id);

        $licencefee = $licencefee->update([
            'lic_name_id'=>$request->itemName,
            'lic_grade_id'=>$request->lic_grade_id,
            'lic_key'=>$request->lic_key,
            'lic_fee_val'=>$request->lic_value
        ]);

        return redirect()->route('admin.licence_fee.index')->with('success','Data update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LicenceFee  $licenceFee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $licencefee = LicenceFee::find($id)->delete();
        return redirect()->route('admin.licence_fee.index')->with('success','Data delete successfully');
    }

    public function dataAjax(Request $request)
    {
        $data = new LicenceName();

        if($request->has('q')){
            $search = $request->q;
            $data = $data->where('lic_name','like','%'.$search.'%');
            
        }
        $data = $data->get();
        // dd($data);
        return response()->json($data);
    }

    public function selectlicencename(Request $request)
    {
        if($request->ajax()){
            $lic_grades = LicGrade::where('lic_name_id',$request->lic_id)->orderBy('created_at','asc')->get();
            echo "<option value=''>Select Licence Grade</opiton>";
            foreach ($lic_grades as $key => $sec) {
                echo "<option value='".$sec->id."'>".$sec->grade."</opiton>";
            }
        }
    }
}
