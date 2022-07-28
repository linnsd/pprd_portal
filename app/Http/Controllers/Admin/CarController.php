<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Car;
use File;
use QrCode;
use URL;
use App\StateDivision;
use App\Driver;
use DB;
use Hashids\Hashids;

class CarController extends Controller
{
    public function __construct()
    {
      $this->middleware('permission:car-list|car-create|car-edit|car-delete', ['only' => ['index','show']]);
      $this->middleware('permission:car-create', ['only' => ['create','store']]);
      $this->middleware('permission:car-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:car-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     
     // dd($request->all());
      $cars = new Car();
      $sdivisions = StateDivision::all();
      $keyword = $request->keyword;
      $check_valid = $request->check_valid;
      $car_type = $request->car_type;

      $sd_id = $request->sd_id;
      
      if(auth()->user()->role_id==3){
        $sd_id = auth()->user()->sd_id;
      }

      if($sd_id!=''){
        $cars = $cars->where('sd_id',$sd_id);
      }

      if($keyword!=''){
        $cars = $cars->where('plate_no','like','%'.$keyword.'%')->orwhere('company_name','like','%'.$keyword.'%');
      }

      if($check_valid=='1'){ // licence valid
          $cars = $cars->WhereRaw('(DATEDIFF( cars.expire_date,  NOW())>30)');
      }

      // for  licence will expire
      if($check_valid=='2'){
          $cars = $cars->WhereRaw('(DATEDIFF(cars.expire_date, NOW())<30) AND (DATEDIFF( cars.expire_date,  NOW())>0)');
      }

      //for licence expired
      if($check_valid=='3'){ 
          $cars = $cars->WhereRaw('(DATEDIFF( cars.expire_date, NOW())<0)');
      }

      //pending 
      if($check_valid=='4'){ 
          $cars = $cars->where('cars.expire_date',null);
      }

      if($car_type!=''){
        $cars = $cars->where('car_type',$car_type);
      }

      if(auth()->user()->loginId=='user1'){
        $cars = $cars->where('addedBy',auth()->user()->loginId);
      }

      $count = $cars->get()->count();

      $cars = $cars->orderBy('created_at','desc')->paginate(10);

      return view('admin.cars.index',compact('cars','count','sdivisions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $state_division = StateDivision::all();
        return view('admin.cars.create',compact('state_division'));
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
             'car_type'=>'required',
             'model'=>'required',
             'type'=>'required',
             'prefix_number'=>'required',
             'prefix_code'=>'required',
             'bowser_no'=>'required',
             // 'capacity'=>'required',
             'sd_id'=>'required',
             'dname'=>'required',
             // 'unit_id'=>'required',
             // 'wheel'=>'required',
             'weight'=>'required', 
             'power'=>'required',
             // 'issue_date'=>'required',
             // 'expire_date'=>'required',
             'eng_no'=>'required',
             'chassis_no'=>'required',
             // 'oil_carry'=>'required',
             // 'oil_carry_back'=>'required',
             'mine_no'=>'required',
           // 'color'=>'required',

             'owner_book_photo'=>'image|mimes:jpeg,png,jpg|max:500',
             'licence_photo_f'=>'image|mimes:jpeg,png,jpg|max:500',
             'licence_photo_b'=>'image|mimes:jpeg,png,jpg|max:500',

             'car_f_photo'=>'image|mimes:jpeg,png,jpg|max:500',
             'car_b_photo'=>'image|mimes:jpeg,png,jpg|max:500',
             'eng_photo'=>'image|mimes:jpeg,png,jpg|max:500',
             'head_room_photo'=>'image|mimes:jpeg,png,jpg|max:500',
             'ka_nya_na_photo'=>'image|mimes:jpeg,png,jpg|max:500',
             'mine_licence_photo'=>'image|mimes:jpeg,png,jpg|max:500'
        ]);

      DB::beginTransaction();
      try {
            $driver = Driver::create([
                'dname' => $request->dname,
            ]);
          // dd($driver);

        $plate_no = substr($request->bowser_no, -4);
        $path= "uploads/cars/".$plate_no;

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
        $owner_book_photo="";
        if($request->file('owner_book_photo')!=NULL){
          $file = $request->file('owner_book_photo');
          $extension = $file->getClientOriginalExtension();
          $owner_book_photo='owner_book_photo_'.date('d-m-Y-H-i-s').'.' . $extension;
          $file->move($path, $owner_book_photo);
        }


        $licence_photo_f="";
        if($request->file('licence_photo_f')!=NULL){
            $file = $request->file('licence_photo_f');
            $extension = $file->getClientOriginalExtension();
            $licence_photo_f='licence_photo_f_'.date('d-m-Y-H-i-s').'.'. $extension;
            $file->move($path, $licence_photo_f);          
        }

        $licence_photo_b="";
        if($request->file('licence_photo_b')!=NULL){
            $file = $request->file('licence_photo_b');
            $extension = $file->getClientOriginalExtension();
            $licence_photo_b='licence_photo_b_'.date('d-m-Y-H-i-s').'.'. $extension;
            $file->move($path, $licence_photo_b);          
        }


        $car_f_photo="";
        if($request->file('car_f_photo')!=NULL){
          $file = $request->file('car_f_photo');
          $extension = $file->getClientOriginalExtension();
          $car_f_photo='car_f_photo_'.date('d-m-Y-H-i-s').'.'. $extension;
          $file->move($path, $car_f_photo);
        }


        $car_b_photo="";
        if($request->file('car_b_photo')!=NULL){
            $file = $request->file('car_b_photo');
            $extension = $file->getClientOriginalExtension();
            $car_b_photo='car_b_photo_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $car_b_photo);          
        }

        $eng_photo="";
        if($request->file('eng_photo')!=NULL){
            $file = $request->file('eng_photo');
            $extension = $file->getClientOriginalExtension();
            $eng_photo='eng_photo_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $eng_photo);          
        }

        $head_room_photo="";
        if($request->file('head_room_photo')!=NULL){
            $file = $request->file('head_room_photo');
            $extension = $file->getClientOriginalExtension();
            $head_room_photo='head_room_photo_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $head_room_photo);          
        }

        $ka_nya_na_photo="";
        if($request->file('ka_nya_na_photo')!=NULL){
            $file = $request->file('ka_nya_na_photo');
            $extension = $file->getClientOriginalExtension();
            $ka_nya_na_photo='ka_nya_na_photo_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $ka_nya_na_photo);          
        }

        $mine_licence_photo="";
        if($request->file('mine_licence_photo')!=NULL){
            $file = $request->file('mine_licence_photo');
            $extension = $file->getClientOriginalExtension();
            $mine_licence_photo='mine_licence_photo_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $mine_licence_photo);          
        }

        $photo1="";
        if($request->file('photo1')!=NULL){
            $file = $request->file('photo1');
            $extension = $file->getClientOriginalExtension();
            $photo1='photo1_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $photo1);          
        }

        $qrcode = QrCode::backgroundColor(255, 255, 0)->color(255, 0, 127)
                            ->format('png')->size(500)
                            ->generate(URL::to('/').$path.'qrcode.png');


        $car_no = $request->prefix_number.$request->prefix_code.'/'.$request->bowser_no;

        $arr=[
               'car_type'=>$request->car_type,
               'car_prefix_no'=>$request->prefix_number,
               'car_prefix_character'=>$request->prefix_code,
               'car_no'=>$request->bowser_no,
               'plate_no'=>$car_no,
               'model'=>$request->model,
               'sd_id'=>$request->sd_id,
               'driver_id'=>$driver->id,
               'type'=>$request->type,
               'capacity'=>$request->capacity,
               'unit_id'=>$request->unit_id,
                'issue_date'=>$request->issue_date,
                // 'oil_carry'=>$request->oil_carry,
                // 'oil_carry_back'=>$request->oil_carry_back,
                'mine_no'=>$request->mine_no,
               // 'wheels'=>$request->wheel,
               'weight'=>$request->weight,
               'power'=>$request->power,
               'expire_date'=>$request->expire_date,
               'eng_no'=>$request->eng_no,
               'chassis_no'=>$request->chassis_no,
               // 'color'=>$request->color,

               'owner_book_photo'=>$owner_book_photo,
               'licence_photo_f'=>$licence_photo_f,
               'licence_photo_b'=>$licence_photo_b,
                'photo1'=>$photo1,
               'car_f_photo'=>$car_f_photo,
               'car_b_photo'=>$car_b_photo,
               'eng_photo'=>$eng_photo,
               'head_room_photo'=>$head_room_photo,
               'ka_nya_na_photo'=>$ka_nya_na_photo,
               'mine_licence_photo'=>$mine_licence_photo,
               'path'=>$path,

              'company_name'=>$request->company_name,
              'fuel_type'=>$request->fuel_type,
              'address'=>$request->address,

              'user_id'=>auth()->user()->id,
              'addedBy'=>auth()->user()->loginId
            ];

        $res=Car::create($arr);
         DB::commit();
        } catch (Exception $e) {
              DB::rollback();
                // something went wrong
                return redirect()->route('admin.drivers.index')
                            ->with('error','Something wrong!');
         }
        return redirect()->route('admin.cars.index')->with('success','Data create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $car = Car::with('statedivisions')->find($id);
        return view('admin.cars.show',compact('car'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::with('drivers')->find($id);
        // dd($car);
        $sdivisions = StateDivision::all();
        return view('admin.cars.edit',compact('car','sdivisions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // dd($request->all());
      $car = Car::findOrFail($id);

       $validate= $request->validate([
           'car_type'=>'required',
           'model'=>'required',
           'type'=>'required',
           // 'capacity'=>'required',
           // 'sd_id'=>'required',
           'dname'=>'required',
           // 'unit_id'=>'required',
           // 'wheel'=>'required',
           'weight'=>'required', 
           // 'power'=>'required',
           // 'issue_date'=>'required',
           // 'expire_date'=>'required',
           // 'eng_no'=>'required',
           'chassis_no'=>'required',
           // 'oil_carry'=>'required',
           // 'oil_carry_back'=>'required',
           'mine_no'=>'required',
        ]);

        $plate_no = substr($request->car_no, -4);

        

        $path= "uploads/cars/".$plate_no;

        if($car->path!=''){
          $path= $car->path;
        }

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
        $owner_book_photo=$car->owner_book_photo;
        if($request->file('owner_book_photo')!=NULL){
          $file = $request->file('owner_book_photo');
          $extension = $file->getClientOriginalExtension();
          $owner_book_photo='owner_book_photo_'.date('d-m-Y-H-i-s').'.' . $extension;
          $file->move($path, $owner_book_photo);
        }


        $licence_photo_f=$car->licence_photo_f;
        if($request->file('licence_photo_f')!=NULL){
            $file = $request->file('licence_photo_f');
            $extension = $file->getClientOriginalExtension();
            $licence_photo_f='licence_photo_f_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $licence_photo_f);          
        }


        $licence_photo_b=$car->licence_photo_b;
        if($request->file('licence_photo_b')!=NULL){
            $file = $request->file('licence_photo_b');
            $extension = $file->getClientOriginalExtension();
            $licence_photo_b='licence_photo_b_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $licence_photo_b);          
        }


        $car_f_photo=$car->car_f_photo;
        if($request->file('car_f_photo')!=NULL){
          $file = $request->file('car_f_photo');
          $extension = $file->getClientOriginalExtension();
          $car_f_photo='car_f_photo_'.date('d-m-Y-H-i-s').'.' . $extension;
          $file->move($path, $car_f_photo);
        }


        $car_b_photo=$car->car_b_photo;
        if($request->file('car_b_photo')!=NULL){
            $file = $request->file('car_b_photo');
            $extension = $file->getClientOriginalExtension();
            $car_b_photo='car_b_photo_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $car_b_photo);          
        }

        $eng_photo=$car->eng_photo;
        if($request->file('eng_photo')!=NULL){
            $file = $request->file('eng_photo');
            $extension = $file->getClientOriginalExtension();
            $eng_photo='eng_photo_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $eng_photo);          
        }

        $head_room_photo=$car->head_room_photo;
        if($request->file('head_room_photo')!=NULL){
            $file = $request->file('head_room_photo');
            $extension = $file->getClientOriginalExtension();
            $head_room_photo='head_room_photo_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $head_room_photo);          
        }

        $ka_nya_na_photo=$car->ka_nya_na_photo;
        if($request->file('ka_nya_na_photo')!=NULL){
            $file = $request->file('ka_nya_na_photo');
            $extension = $file->getClientOriginalExtension();
            $ka_nya_na_photo='ka_nya_na_photo_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $ka_nya_na_photo);          
        }

        $mine_licence_photo=$car->mine_licence_photo;
        if($request->file('mine_licence_photo')!=NULL){
            $file = $request->file('mine_licence_photo');
            $extension = $file->getClientOriginalExtension();
            $mine_licence_photo='mine_licence_photo_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $mine_licence_photo);          
        }

        $photo1=$car->photo1;
        if($request->file('photo1')!=NULL){
            $file = $request->file('photo1');
            $extension = $file->getClientOriginalExtension();
            $photo1='photo1_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $photo1);          
        }

      
         $driverId = $car->driver_id;

         $cars = DB::table('drivers')->where('id',$driverId)->delete();
        // dd($cars);
        $driver = Driver::create([
            'dname' => $request->dname,
        ]);
        // dd($driver);
        $locked = 0;
        if($request->issue_date!='' && $request->expire_date!=''){
          $locked = 1;
        }

        $car_no = $request->prefix_number.$request->prefix_code.'/'.$request->bowser_no;

        $arr=[
               'car_type'=>$request->car_type,
               'car_prefix_no'=>$request->prefix_number,
               'car_prefix_character'=>$request->prefix_code,
               'car_no'=>$request->bowser_no,
               'plate_no'=>$car_no,
               'sd_id'=>$car->sd_id,
               'driver_id' => $driver->id,
               'model'=>$request->model,
               'type'=>$request->type,
               'capacity'=>$request->capacity,
               'unit_id'=>$request->unit_id,
               // 'wheels'=>$request->wheel,
               'weight'=>$request->weight,
               'power'=>$request->power,
               'issue_date'=>$request->issue_date,
               'expire_date'=>$request->expire_date,
               'eng_no'=>$request->eng_no,
               'chassis_no'=>$request->chassis_no,
               // 'oil_carry'=>$request->oil_carry,
                // 'oil_carry_back'=>$request->oil_carry_back,
                'mine_no'=>$request->mine_no,
               // 'color'=>$request->color,

               'owner_book_photo'=>$owner_book_photo,
               'licence_photo_f'=>$licence_photo_f,
               'licence_photo_b'=>$licence_photo_b,
               'photo1'=>$photo1,
               'car_f_photo'=>$car_f_photo,
               'car_b_photo'=>$car_b_photo,
               'eng_photo'=>$eng_photo,
               'head_room_photo'=>$head_room_photo,
               'ka_nya_na_photo'=>$ka_nya_na_photo,
               'mine_licence_photo'=>$mine_licence_photo,
               'path'=>$path,

               'company_name'=>$request->company_name,
               'fuel_type'=>$request->fuel_type,
               'address'=>$request->address,
                'locked'=>$locked
            ];


        $car->fill($arr)->save();


        return redirect()->route('admin.cars.index')->with('success','Data Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::find($id);

        $owner_book_photo =public_path() .'/'. $car->path.'/'.$car->owner_book_photo;
        if (File::exists($owner_book_photo)) {
            File::delete($owner_book_photo);
        }

        $licence_photo_f =public_path() .'/'. $car->path.'/'.$car->licence_photo_f;
        if (File::exists($licence_photo_f)) {
            File::delete($licence_photo_f);
        }

        $licence_photo_b =public_path() .'/'. $car->path.'/'.$car->licence_photo_b;
        if (File::exists($licence_photo_b)) {
            File::delete($licence_photo_b);
        }

        $car_f_photo =public_path() .'/'. $car->path.'/'.$car->car_f_photo;
        if (File::exists($car_f_photo)) {
            File::delete($car_f_photo);
        }

        $car_b_photo =public_path() .'/'. $car->path.'/'.$car->car_b_photo;
        if (File::exists($car_b_photo)) {
            File::delete($car_b_photo);
        }

        $eng_photo =public_path() .'/'. $car->path.'/'.$car->eng_photo;
        if (File::exists($eng_photo)) {
            File::delete($eng_photo);
        }

        $head_room_photo =public_path() .'/'. $car->path.'/'.$car->head_room_photo;
        if (File::exists($head_room_photo)) {
            File::delete($head_room_photo);
        }

        $ka_nya_na_photo =public_path() .'/'. $car->path.'/'.$car->ka_nya_na_photo;
        if (File::exists($ka_nya_na_photo)) {
            File::delete($ka_nya_na_photo);
        }

        $mine_licence_photo =public_path() .'/'. $car->path.'/'.$car->mine_licence_photo;
        if (File::exists($mine_licence_photo)) {
            File::delete($mine_licence_photo);
        }

      $car =$car->delete();
      return redirect()->back()->with('success','Deleted!');

    }

    public function print($id)
    {
      $car = Car::with('statedivisions')->find($id);
      $hashids = new Hashids('', 10); // pad to length 10
      $hashids = $hashids->encodeHex($car->id); 
      return view('admin.cars.print_new',compact('car','hashids'));
    }

    public function oldshowqrdata($id)
    {
      $car = Car::with('statedivisions')->find($id);
      return view('frontend.qrdata',compact('car'));
    }

    public function showqrdata($hashid)
    {
      $hashids = new Hashids('', 10); // pad to length 10
      $id = $hashids->decodeHex($hashid); 
      $car = Car::with('statedivisions')->find($id);
      return view('frontend.qrdata',compact('car'));
    }

     public function downloadQrCode($id)
    {

        $this->generateCarQR($id);

        $car = Car::findOrFail($id);
        $strpath = public_path().'/'.$car->path."/carqrcode.png";

        $myFile = str_replace("\\", '/', $strpath);
        $headers = ['Content-Type: application/*'];
        $newName ='carqrcode.png';


        return response()->download($myFile, $newName, $headers);
    }


    public function generateCarQR($id)
    {
        $car = Car::findorfail($id);
        $destinationPath = public_path() .'/'. $car->path . '/';

        if (!File::isDirectory($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
        }

        if (File::exists($destinationPath . 'qrcode.png')) {
            File::delete($destinationPath . 'qrcode.png');
        }

        $hashids = new Hashids('', 10); // pad to length 10
        $hashids = $hashids->encodeHex($car->id); 

        $qrcode = QrCode::backgroundColor(255, 255, 0)->color(255, 0, 127)
            ->format('png')->size(500)
            ->generate(URL::to('/') . '/' . $hashids.'/c', $destinationPath . 'carqrcode.png');

        return;
    }

    public function lockCar($id){
      $car = Car::findorfail($id);

      $car->fill(
        [
          'locked'=>($car->locked==0)?1:0
        ]
      )->save();

      return redirect()->back()->with('success','Updated!');
    }

    public function qr_back($id)
    {
      $car = Car::with('statedivisions')->find($id);
      $hashids = new Hashids('', 10); // pad to length 10
      $hashids = $hashids->encodeHex($car->id); 
      return view('admin.cars.qrback',compact('car','hashids'));
    }

    public function number(Request $request)
    {
      // dd($request->all());
      $request->validate([
            'no' => ['required'],
        ]);
      $car = Car::find($request->car_id);
      // dd($car);
      $car = $car->update(['no'=>$request->no]);

      return redirect()->back()->with('success','Updated!');

    }

    public function print_dio($id)
    {
      $car = Car::with('statedivisions')->find($id);
      $hashids = new Hashids('', 10); // pad to length 10
      $hashids = $hashids->encodeHex($car->id); 
      return view('admin.cars.print',compact('car','hashids'));
    }
}
