<?php

namespace App\Http\Controllers\Admin;

use App\ReportTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $report_times = ReportTime::list($request);

        $count = $report_times->get()->count();

        $report_times = $report_times->orderBy('report_times.created_at','asc')->paginate(10);

        return view('admin.report_time.index',compact('report_times','count'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.report_time.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = ReportTime::store_data($request);
        return redirect()->route('admin.report_times.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReportTime  $reportTime
     * @return \Illuminate\Http\Response
     */
    public function show(ReportTime $reportTime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReportTime  $reportTime
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report_time = ReportTime::find($id);

        return view('admin.report_time.edit',compact('report_time'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReportTime  $reportTime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = ReportTime::update_data($request,$id);
        return redirect()->route('admin.report_times.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReportTime  $reportTime
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ReportTime::find($id)->delete();
        return redirect()->route('admin.report_times.index')->with('success','Success');
    }

    public function report_time_status(Request $request)
    {
        $report_time = ReportTime::find($request->rep_time_id);
        $report_time->active_status = $request->status;

        $report_time->save();
        return response()->json(['success'=>'Status change successfully.']);
    }

    public function change_minor_status(Request $request)
    {
        $report_time = ReportTime::find($request->rep_time_id);
        $report_time->shop_type = $request->status;

        $report_time->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
}
