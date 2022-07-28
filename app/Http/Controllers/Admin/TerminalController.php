<?php

namespace App\Http\Controllers\Admin;

use App\Terminal;
use App\StateDivision;
use App\Township;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TerminalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $terminals = new Terminal();
        $sdivisions = StateDivision::all();
        $townships = Township::all();
        $keyword = $request->keyword;
        $sd_id = $request->sd_id;
        $township_id = $request->township_id;
        if ($keyword != '') {
            $terminals = $terminals->where('company_name','like','%'.$keyword.'%');
        }
        if ($sd_id != '') {
            $terminals = $terminals->where('sd_id',$sd_id);
        }
        if ($township_id != '') {
            $terminals = $terminals->where('tsh_id',$township_id);
        }
         $count = $terminals->get()->count();

        $terminals = $terminals->orderBy('created_at','desc')->paginate(10);
        return view('admin.terminal.index',compact('terminals','count','sdivisions','townships'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statedivisions = StateDivision::all();
        $townships = Township::all();
        return view('admin.terminal.create',compact('statedivisions','townships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'company_name'=>'required',
            'sd_id'=>'required',
            'tsh_id'=>'required',
            'licence_no'=>'required',
            'issue_date'=>'required',
            'gasoline'=>'required',
            'disel'=>'required',
            'location'=>'required'
        ]);
        $terminal = Terminal::create([
            'company_name'=>$request->company_name,
            'nrc'=>$request->nrc,
            'sd_id'=>$request->sd_id,
            'tsh_id'=>$request->tsh_id,
            'comp_licence_no'=>$request->comp_licence_no,
            'lic_no'=>$request->licence_no,
            'comp_issue_date'=>$request->comp_issue_date,
            'issue_date'=>$request->issue_date,
            'gasoline'=>$request->gasoline,
            'disel'=>$request->disel,
            'remark'=>$request->remark,
            'location'=>$request->location
        ]);
        return redirect()->route('admin.terminal.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Terminal  $terminal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $terminal = Terminal::find($id);
        return view('admin.terminal.show',compact('terminal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Terminal  $terminal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $terminal = Terminal::find($id);
        $statedivisions = StateDivision::all();
        $townships = Township::all();
        return view('admin.terminal.edit',compact('terminal','statedivisions','townships'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Terminal  $terminal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'company_name'=>'required',
            'sd_id'=>'required',
            'tsh_id'=>'required',
            'licence_no'=>'required',
            'issue_date'=>'required',
            'gasoline'=>'required',
            'disel'=>'required',
        ]);
        $terminal = Terminal::find($id);
        $terminal = $terminal->update([
            'company_name'=>$request->company_name,
            'nrc'=>$request->nrc,
            'sd_id'=>$request->sd_id,
            'tsh_id'=>$request->tsh_id,
            'licence_no'=>$request->licence_no,
            'comp_licence_no'=>$request->comp_licence_no,
            'comp_issue_date'=>$request->comp_issue_date,
            'issue_date'=>$request->issue_date,
            'gasoline'=>$request->gasoline,
            'disel'=>$request->disel,
            'remark'=>$request->remark
        ]);
        return redirect()->route('admin.terminal.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Terminal  $terminal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $terminal = Terminal::find($id)->delete();
        return redirect()->route('admin.terminal.index')->with('success','Success');
    }
}
