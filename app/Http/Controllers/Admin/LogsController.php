<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Spatie\Activitylog\Models\Activity;

class LogsController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:logs-list|logs-delete', ['only' => ['index','destroy']]);
        $this->middleware('permission:logs-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
    	$logs = Activity::orderBy('id','desc')->paginate(20);
    	return view('admin.logs.activity_logs',compact('logs'));
		
    }


    public function show($id)
    {
        $log = Activity::find($id);
      
        return view('admin.logs.show',compact('log'));
       
    }

    public function delete($id)
    {
    	$logs = Activity::find($id)->delete();
      
        return redirect()->route('admin.logs.index')
                        ->with('success',' Logs File  delete successful.');
       
    }
}
