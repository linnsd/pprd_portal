<?php

namespace App\Http\Controllers\Admin;

use App\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $notifications = Notification::list($request);

        $count = $notifications->count();

        $notifications = $notifications->orderBy('created_at','asc')->paginate(10);

        return view('admin.notification.index',compact('notifications','count'))->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Notification::store_data($request);

        return redirect()->route('admin.notifications.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = Notification::find($id);

        return view('admin.notification.detail',compact('notification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notification = Notification::find($id);
        return view('admin.notification.edit',compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $noti = Notification::update_data($request,$id);
        return redirect()->route('admin.notifications.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $storagePath = public_path() . '/uploads/noti_photo/';

         $noti = Notification::find($id);

        if (File::exists($storagePath . $noti->photo)) {
            File::delete($storagePath . $noti->photo);
        };


        $noti = Notification::find($id)->delete();

        return redirect()->route('admin.notifications.index')->with('success','Success');
    }

    public function change_noti_status(Request $request)
    {
        $notification = Notification::find($request->noti_id);
        $notification->status = $request->status;

        $notification->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
}
