<?php

namespace App\Http\Controllers\Admin;

use App\LicGrade;
use App\LicenceName;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LicGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $lic_name_id = $request->lic_name_id;
        $lic_grades = new LicGrade();
        if ($keyword != '') {
            $lic_grades = $lic_grades->where('grade','like','%'.$keyword.'%');
        }

        if ($lic_name_id != '') {
            $lic_grades = $lic_grades->where('lic_name_id',$lic_name_id);
        }

        $lic_names = LicenceName::all();

        $count = $lic_grades->get()->count();

      $lic_grades = $lic_grades->orderBy('created_at','asc')->paginate(10);
        return view('admin.licence_grade.index',compact('lic_grades','count','lic_names'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $licence_names = LicenceName::all();
        return view('admin.licence_grade.create',compact('licence_names'));
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
        $request->validate([
             'lic_name_id'=>'required',
             'grade'=>'required'
         ]);

        $licencegrade = LicGrade::create([
            'lic_name_id'=>$request->lic_name_id,
            'grade'=>$request->grade
        ]);

        return redirect()->route('admin.licence_grade.index')->with('success','Data create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LicGrade  $licGrade
     * @return \Illuminate\Http\Response
     */
    public function show(LicGrade $licGrade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LicGrade  $licGrade
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lic_grade = LicGrade::find($id);
        $licence_names = LicenceName::all();
        return view('admin.licence_grade.edit',compact('lic_grade','licence_names'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LicGrade  $licGrade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
             'lic_name_id'=>'required',
             'grade'=>'required'
         ]);

        $lic_grade = LicGrade::find($id);
        $lic_grade = $lic_grade->update([
            'lic_name_id'=>$request->lic_name_id,
            'grade'=>$request->grade
        ]);
        return redirect()->route('admin.licence_grade.index')->with('success','Data update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LicGrade  $licGrade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $licence_grade = LicGrade::find($id)->delete();
        return redirect()->route('admin.licence_grade.index')->with('success','Data delete successfully');
    }
}
