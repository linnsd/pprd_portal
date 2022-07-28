<?php


// Route::get('/','FrontendController@index')->name('frontend.index');
Route::get('/login','FrontendController@login')->name('frontend.login');

Route::get('/register','FrontendController@register')->name('frontend.register');
Route::post('/register/post','FrontendController@registerPost')->name('frontend.register.store');
Route::get('/register/complete/{id}','FrontendController@registerComplete')->name('register.complete');

Route::get('/about','FrontendController@about')->name('frontend.about');
Route::get('/contact','FrontendController@contact')->name('frontend.contact');
Route::get('/news','FrontendController@news')->name('frontend.news');
Route::get('/news/{id}','FrontendController@newsdetail')->name('frontend.newsdetail');
Route::post('/contact/post','FrontendController@contactPost')->name('frontend.contact.post');


Route::get('/',function(){
   return redirect()->route('admin.home');
});

//---------------------------- Admin Routes------------------------------------------------------------
Route::get('/home', function () {
    return redirect()->route('admin.home');
});

Route::get('/admin', function () {
    return redirect()->route('admin.home');
});

// Authentication Routes...
Route::get('/admin/login', 'Admin\AuthController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Admin\AuthController@login')->name('admin.login');

Route::post('/admin/logout', 'Admin\AuthController@logout')->name('admin.logout')->middleware('admin');;

Route::get('password/reset', 'Admin\AuthController@showLinkRequestForm')->name('auth.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Admin\AuthController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');



Route::group(['prefix' => 'admin','namespace' => 'Admin', 'as' => 'admin.' , 'middleware' => 'admin'], function () {
    
    Route::get('/home','HomeController@index')->name('home');

    Route::resource('cars', 'CarController');

    Route::resource('roles', 'RoleController');

    Route::resource('users','UserController');

    Route::resource('states-divisons', 'StateDivisionController');
    Route::resource('township', 'TownshipController');
    Route::resource('licence', 'LicenceController');

    //Licence Group
    Route::resource('licence_gp','LicenceGroupController');

    Route::resource('sub_lic_gp','SubLicGroupController');

    Route::resource('licence_name','LicenceNameController');

    Route::resource('licence_fee','LicenceFeeController');

    Route::resource('licence_grade','LicGradeController');

    Route::resource('shops', 'ShopController');

    Route::resource('terminal', 'TerminalController');

     Route::resource('airport_oil', 'AirportOilController');

    // Route::resource('machine_oil', 'ShopController');
    Route::resource('machine_oil', 'MachineOilController');

    Route::resource('village_shop', 'VillageShopController');

    Route::get('village_shop/{id}','VillageShopController@print')->name('village_shop.print');

    Route::get('profile','HomeController@profile')->name('profile');

    Route::get('password/change','HomeController@changePassword')->name('change.password');

    Route::post('password/reset','HomeController@resetPassword')->name('resetPassword');

    Route::post('shop/password/reset','ShopController@changePassword')->name('changePassword');

    Route::post('car/no','CarController@number')->name('number');

    Route::get('/car/download/qr/{id}',"CarController@downloadQrCode")->name('car.downloadqr');

    Route::get('/car/locked/{id}',"CarController@lockCar")->name('cars.locked');

      // Backup routes
    Route::get('/backup', 'BackupController@index')->name('backup.index');
    Route::get('/backup/create', 'BackupController@create')->name('backup.create');
    Route::get('/backup/download/{file_name}', 'BackupController@download')->name('backup.download');
    Route::get('/backup/delete/{file_name}', 'BackupController@delete')->name('backup.delete');

    //activity logs
    Route::get('/logs','LogsController@index')->name('logs.index');
    Route::get('/logs/show/{id}', 'LogsController@show')->name('logs.show');
    Route::get('/logs/delete/{id}', 'LogsController@delete')->name('logs.delete');

    //Setting Routes
    Route::get('setting','SettingController@siteSetting')->name('site.setting');
    Route::get('setting/generate/apikey','SettingController@generateApiKey')->name('generate.apikey');
    Route::post('setting/update','SettingController@updateSetting')->name('setting.update');

    //fuel shoop Route
    Route::resource('fuel_shops','FuelShopController');

    //get_tsh
    Route::post('get_tsh','FuelShopController@get_tsh')->name('get_tsh');

    //change_shop_status
    Route::get('change_shop_status','FuelShopController@change_shop_status')->name('change_shop_status');

    Route::get('main_shop_report','FuelShopController@main_shop_report')->name('main_shop_report.index');

    Route::resource('shop_fuel_capacity','ShopFuelCapacityController');

    Route::resource('pre_shops','ShopPreorderController');

    Route::resource('daily_shop_reports','ShopDailyRecordController');

    Route::post('get_shop_fuel','ShopDailyRecordController@get_shop_fuel')->name('get_shop_fuel');

    
    Route::post('shop_photo_update','FuelShopController@shop_photo_update')->name('shop_photo_update');

    Route::get('attach_delete','FuelShopController@attach_delete')->name('attach_delete');

    Route::post('lic_photo_update','FuelShopController@lic_photo_update')->name('lic_photo_update');

    Route::get('lic_photo_delete','FuelShopController@lic_photo_delete')->name('lic_photo_delete');

    Route::post('get_using_shop_fuel','FuelShopController@get_using_shop_fuel')->name('get_using_shop_fuel');

    Route::resource('fuel_types','FuelTypeController');

    //fuel type status change
    Route::get('fuel_type_status','FuelTypeController@change_type_status')->name('fuel_type_status');

    //report_times
    Route::resource('report_times','ReportTimeController');

    //report_time_status
    Route::get('report_time_status','ReportTimeController@report_time_status')->name('report_time_status');

    //change_minor_status
    Route::get('change_minor_status','ReportTimeController@change_minor_status')->name('change_minor_status');

    // number_update
     Route::post('number_update','ShopFuelCapacityController@number_update')->name('number_update');

     //get_fuel_type_by_shop
     Route::post('get_fuel_type_by_shop','ShopDailyRecordController@get_fuel_type_by_shop')->name('get_fuel_type_by_shop');
     
    //get_report_time_by_shop
     Route::post('get_report_time_by_shop','ShopDailyRecordController@get_report_time_by_shop')->name('get_report_time_by_shop');

     //get_prev_balance
     Route::post('get_prev_balance','ShopDailyRecordController@get_prev_balance')->name('get_prev_balance');

     Route::get('no_report_shops','ShopDailyRecordController@no_report_shops')->name('no_report_shops');

     Route::post('dio_approve','ShopDailyRecordController@dio_approve')->name('dio_approve');

     //notification module
     Route::resource('notifications','NotificationController');

     //change noti status
     Route::get('change_noti_status','NotificationController@change_noti_status')->name('change_noti_status');

     //lock unlock
     Route::get('lock_unlock_capacity/{id}','ShopFuelCapacityController@lock_unlock_capacity')->name('lock_unlock_capacity');

     //get_lic_prefix
     Route::get('get_lic_prefix','FuelShopController@get_lic_prefix')->name('get_lic_prefix');

     // shop_pass_update
     Route::post('shop_pass_update','FuelShopController@shop_pass_update')->name('shop_pass_update');

});

Route::get('/search_ajax', 'Admin\LicenceFeeController@dataAjax');

//car print
Route::get('/cars/prints/{id}',"Admin\CarController@print")->name('admin.cars.print_new');

//dio print
Route::get('/cars/dio_print/{id}',"Admin\CarController@print_dio")->name('admin.cars.print');

//qr back
Route::get('/cars/qr_back/{id}',"Admin\CarController@qr_back")->name('admin.cars.qr_back');

//car old qr scan route
Route::get('/car/getdata/{id}',"Admin\CarController@oldshowqrdata")->name('admin.cars.oldshowqrdata');
//car new qr scan route
Route::get('/{id}/c',"Admin\CarController@showqrdata")->name('admin.cars.showqrdata');

//shop print
Route::get('/shops/prints/{id}',"Admin\ShopController@print")->name('admin.shops.print');
//old shop qr scan 
Route::get('/shop/getdata/{id}',"Admin\ShopController@oldshowqrdata")->name('admin.shops.oldshowqrdata');
//new shop qr scan
Route::get('/{id}/s',"Admin\ShopController@showqrdata")->name('admin.shops.showqrdata');

Route::post('/getTownshipByStateDivision', 'Admin\ShopController@getTownshipByStateDivision')->name('frontend.gettownship');

Route::get('/select2-autocomplete-ajax', 'Admin\ShopController@getSelect2Ajax')->name('frontend.getSelect2Ajax');

//shop owner

Route::get('/admin/myshop',"Admin\ShopController@myShop")->name('myshop.index');

Route::get('/admin/signage',"Admin\ShopController@signage")->name('myshop.signage');

Route::get('/download/qr/{id}',"Admin\ShopController@downloadQrCode")->name('shop.downloadqr');

Route::get('/printSignage/{id}',"Admin\ShopController@printSignage")->name('signage.print');

//car csv import , excel export and download csv sample
Route::post('/cars/csvimport', 'Admin\ExcelController@importCar')->name('cars.import');
Route::post('/cars/export',"Admin\ExcelController@exportCar")->name('cars.export');
Route::get('/cars/csv/download','Admin\ExcelController@downloadCarCSV')->name('cars.download.csv');

//car excel export for state divisions and townships
Route::get('/states-divisons/excel/export',"Admin\ExcelController@exportStateDivisions")->name('states-divisons.export');
Route::get('/townships/excel/export',"Admin\ExcelController@exportTownship")->name('townships.export');

Route::get('shop/signage/downloadpsd','Admin\ShopController@downloadPSD')->name('shop.signage.downloadpsd');

Route::get('shop/signage/downloadjpg/{id}','Admin\ShopController@downloadJPG')->name('shop.signage.downloadjpg');

//shop csv import export and csv template download
Route::post('/shop/csvimport', 'Admin\ExcelController@importShop')->name('shops.import');

Route::post('/machine_oil/csvimport', 'Admin\ExcelController@importShop')->name('machine_oil.import');

Route::post('/village_shop/csvimport', 'Admin\ExcelController@importVillageShop')->name('village_shop.import');

Route::post('/terminal/excel/export',"Admin\ExcelController@exportTerminal")->name('terminal.export');

Route::post('/terminal/csvimport', 'Admin\ExcelController@importTerminal')->name('terminal.import');

Route::post('/airport_oil/excel/export',"Admin\ExcelController@exportAirport")->name('airport_oil.export');

Route::post('/airport_oil/csvimport', 'Admin\ExcelController@importAirport')->name('airport_oil.import');

Route::post('/shops/excel/export',"Admin\ExcelController@exportShops")->name('shops.export');

Route::post('/machine_oil/excel/export',"Admin\ExcelController@exportShops")->name('machine_oil.export');

Route::post('/village_shop/excel/export',"Admin\ExcelController@exportVillageShop")->name('village_shop.export');

Route::get('/shops/csv/download','Admin\ExcelController@downloadShopsCSV')->name('shops.download.csv');


Route::get('/machine_oil/csv/download','Admin\ExcelController@downloadShopsCSV')->name('machine_oil.download.csv');

Route::get('/village_shop/csv/download','Admin\ExcelController@downloadVillageShop')->name('village_shop.download.csv');


Route::get('set-shopowner-role','Admin\UserController@setShopOwnerRole');

Route::get('widget-data','Frontend\HomeController@widgetData');

Route::post('save-canvas','Admin\ShopController@saveCanvas'); 

Route::get('change-status-user','Admin\UserController@changestatususer')->name('change-status-user');

Route::post('select-lic-name','Admin\LicenceFeeController@selectlicencename')->name('select-lic-name');
