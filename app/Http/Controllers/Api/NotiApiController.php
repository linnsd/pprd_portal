<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notification;

class NotiApiController extends Controller
{

	public function noti_list()
	{
		$notifications = new Notification();
		$notifications = $notifications->where('status',1)->orderby('created_at','desc')->limit('10')->paginate(10);

		 return response(['noti_list' => $notifications,'message'=>"Success",'status'=>1]);
	}
	
}