<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/shops','Api\ShopApiController@getAllShops');

Route::get('/cars','Api\CarApiController@getAllCars');

Route::post('/getshopbylicence','Api\ShopApiController@getshopbylicence');

Route::post('login', 'Api\AuthApiController@login');

Route::post('dashboard','Api\DashboardApiController@main_dashboard');

Route::post('change_password','Api\AuthApiController@change_password');

Route::post('shop_daily_reports','Api\DailyReportApiController@shop_daily_reports');

Route::post('daily_report_detail','Api\DailyReportApiController@daily_report_detail');

Route::post('master_data','Api\FuelListApiController@master_data');

Route::post('create_report','Api\DailyReportApiController@create_report');

Route::get('noti_list','Api\NotiApiController@noti_list');

Route::post('order_list','Api\DailyReportApiController@order_list');

Route::post('order_detail','Api\DailyReportApiController@order_detail');

Route::post('profile_update','Api\AuthApiController@profile_update');
