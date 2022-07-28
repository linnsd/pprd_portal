<?php

namespace App\Http\Controllers\Admin;

use App\MachineOil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shops;
use App\StateDivision;
use App\Township;
use App\Licence;
use App\LicenceName;
use App\LicGrade;
use App\User;
use File;
use QrCode;
use URL;
use Illuminate\Support\Facades\Hash;
use DB;
use Hashids\Hashids;


class MachineOilController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:shop-list|shop-create|shop-edit|shop-delete', ['only' => ['index','show']]);
        $this->middleware('permission:shop-create', ['only' => ['create','store']]);
        $this->middleware('permission:shop-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:shop-delete', ['only' => ['destroy']]);

        $this->middleware('permission:my-shop-list', ['only' => ['myShop']]);
        $this->middleware('permission:signage-show', ['only' => ['signage']]);
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


      // dd($request->all());
      $sdivisions = StateDivision::all();

      $townships = new Township();

      $fuel_types = DB::table('machine_oil')
                 ->select('fuel_type')
                 ->groupBy('fuel_type')
                 ->get();
      // dd($fuel_types);

      if(auth()->user()->role_id==3){
        $townships = $townships->where('sd_id',auth()->user()->sd_id)->get();
      }

      $townships = $townships->all();

      $data = new MachineOil();

      $keyword = $request->keyword;

      if($keyword!=''){
        $data = $data->where('shop_name','like','%'.$keyword.'%')->orWhere('owner','like','%'.$keyword.'%')->orWhere('licence_no','like','%'.$keyword.'%');
      }

      $fuel_type = $request->fuel_id;

      if($fuel_type!=''){
        $data = $data->where('fuel_type','like','%'.$fuel_type.'%');
      }

      $sd_id = $request->sd_id;
      if(auth()->user()->role_id==3){
        $sd_id = auth()->user()->sd_id;
      }

      if($sd_id!=''){
        $data = $data->where('sd_id',$sd_id);
      }

      $tsh_id = $request->township_id;
      if($tsh_id!=''){
        $data = $data->where('tsh_id',$tsh_id);
      }

      $count = $data->get()->count();

      $shops = $data->orderBy('created_at','asc')->paginate(10);

      return view('admin.machine_oil.index',compact('shops','count','sdivisions','townships','fuel_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sdivisions = StateDivision::all();
      $townships = [];

      if(auth()->user()->role_id==3){
        $townships = Township::where('sd_id',auth()->user()->sd_id)->get();
      }
      
      $licences = LicenceName::all();
      $lic_grades = LicGrade::all();
      return view('admin.machine_oil.create',compact('sdivisions','licences','townships','lic_grades'));
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

      if(auth()->user()->role_id==1){
         $request->validate([
            'sd_id'=>'required',
            'tsh_id'=>'required',
            'shop_name'=>'required',
            'owner'=>'required',
            'licence_no'=>'required|unique:shops',
            'fuel_type'=>'required',
            'storage'=>'required',
            'expire_date'=>'required',
            'location'=>'required',
            'lic_name_id'=>'required',
            'lic_grade_id'=>'required',
            'company_no'=>'required',
            'lic_grade_id'=>'required',

            'photo1'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo2'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo3'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo4'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo5'=>'image|mimes:jpeg,png,jpg|max:500',

            'photo6'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo7'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo8'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo9'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo10'=>'image|mimes:jpeg,png,jpg|max:500',

        ]);
       }else{
         $request->validate([
            'sd_id'=>'required',
            'tsh_id'=>'required',
            'shop_name'=>'required',
            'owner'=>'required',
            'fuel_type'=>'required',
            'storage'=>'required',
            'location'=>'required',
            'licence_id'=>'required',

            'photo1'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo2'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo3'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo4'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo5'=>'image|mimes:jpeg,png,jpg|max:500',

            'photo6'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo7'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo8'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo9'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo10'=>'image|mimes:jpeg,png,jpg|max:500',

        ]);
       }
      


      DB::beginTransaction();
      try {
          
         
        $path= "uploads/shops/".$request->licence_no;

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        $photo1="";
        if($request->file('photo1')!=NULL){
          $file = $request->file('photo1');
          $extension = $file->getClientOriginalExtension();
          $photo1='photo1_'.date('d-m-Y-H-i-s').'.' . $extension;
          $file->move($path, $photo1);
        }


        $photo2="";
        if($request->file('photo2')!=NULL){
            $file = $request->file('photo2');
            $extension = $file->getClientOriginalExtension();
            $photo2='photo2_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $photo2);          
        }

        $photo3="";
        if($request->file('photo3')!=NULL){
            $file = $request->file('photo3');
            $extension = $file->getClientOriginalExtension();
            $photo3='photo3_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $photo3);          
        }


        $photo4="";
        if($request->file('photo4')!=NULL){
          $file = $request->file('photo4');
          $extension = $file->getClientOriginalExtension();
          $photo4='photo4_'.date('d-m-Y-H-i-s').'.' . $extension;
          $file->move($path, $photo4);
        }


        $photo5="";
        if($request->file('photo5')!=NULL){
            $file = $request->file('photo5');
            $extension = $file->getClientOriginalExtension();
            $photo5='photo5_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $photo5);          
        }

        $photo6="";
        if($request->file('photo6')!=NULL){
          $file = $request->file('photo6');
          $extension = $file->getClientOriginalExtension();
          $photo6='photo6_'.date('d-m-Y-H-i-s').'.' . $extension;
          $file->move($path, $photo6);
        }


        $photo7="";
        if($request->file('photo7')!=NULL){
            $file = $request->file('photo7');
            $extension = $file->getClientOriginalExtension();
            $photo7='photo7_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $photo7);          
        }

        $photo8="";
        if($request->file('photo8')!=NULL){
            $file = $request->file('photo8');
            $extension = $file->getClientOriginalExtension();
            $photo8='photo8_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $photo8);          
        }


        $photo9="";
        if($request->file('photo9')!=NULL){
          $file = $request->file('photo9');
          $extension = $file->getClientOriginalExtension();
          $photo9='photo9_'.date('d-m-Y-H-i-s').'.' . $extension;
          $file->move($path, $photo9);
        }


        $photo10="";
        if($request->file('photo10')!=NULL){
            $file = $request->file('photo10');
            $extension = $file->getClientOriginalExtension();
            $photo10='photo10_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $photo10);          
        }

        $user = new User();
        if($request->licence_no!=''){
           $user = $user->create(
            [
              'role_id'=>2,
              'sd_id'=>$request->sd_id,
              'loginId'=>$request->licence_no,
              'name'=>$request->shop_name,
              'password'=>Hash::make($request->password),
            ]
          );

          $user->assignRole("Shop Owner");
        }
       
       
        $arr=[
              'user_id'=>$user->id,
              'sd_id'=>$request->sd_id,
              'tsh_id'=>$request->tsh_id,
              'shop_name'=>$request->shop_name,
              'owner'=>$request->owner,
              'licence_no'=>$request->licence_no,
              'fuel_type'=>$request->fuel_type,
              'gasoline'=>$request->gasoline,
              'diesel'=>$request->diesel,
              'storage'=>$request->storage,
              'issue_date'=>($request->issue_date)?$request->issue_date:NULL,
              'expire_date'=>($request->expire_date)?$request->expire_date:NULL,
              'location'=>$request->location,
              'lat'=>$request->lat,
              'lng'=>$request->lng,
              'licence_id'=>($request->lic_name_id)?$request->lic_name_id:'',
              'lic_grade_id'=>($request->lic_grade_id)?$request->lic_grade_id:'',
              'company_no'=>($request->company_no)?$request->company_no:'',
              'ph_no'=>$request->ph_no,
              'email'=>$request->email,
              'photo1'=>$photo1,
              'photo2'=>$photo2,
              'photo3'=>$photo3,
              'photo4'=>$photo4,
              'photo5'=>$photo5,

              'photo6'=>$photo6,
              'photo7'=>$photo7,
              'photo8'=>$photo8,
              'photo9'=>$photo9,
              'photo10'=>$photo10,
              'path'=>$path
            ];

        $res=MachineOil::create($arr);
          DB::commit();
      } catch (\Exception $e) {
        dd($e);
          DB::rollback();
          return redirect()->route('admin.machine_oil.index')->with('error','Something went wrong!');
      }

      return redirect()->route('admin.machine_oil.index')->with('success','Data create successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $shop = MachineOil::find($id);
        return view('admin.machine_oil.show',compact('shop'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $sdivisions = StateDivision::all();
      $townships = new Township();

      $shop = MachineOil::find($id);
      // dd($shop);

      $townships = $townships->where('sd_id',$shop->sd_id)->get();
    
     
      $licences = LicenceName::all();
      $lic_grades = LicGrade::where('lic_name_id',$shop->licence_id)->get();
      // dd($lic_grades);
    
      return view('admin.machine_oil.edit',compact('shop','sdivisions','townships','licences','lic_grades'));
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
      if(auth()->user()->role_id==1){
        $request->validate([
            // 'sd_id'=>'required',
            // 'tsh_id'=>'required',
            'shop_name'=>'required',
            'owner'=>'required',
            'licence_no'=>'required',
            'fuel_type'=>'required',
            'storage'=>'required',
            'expire_date'=>'required',
            'location'=>'required',
            'lic_name_id'=>'required',
            'lic_grade_id'=>'required',
            'company_no'=>'required',
            'lic_grade_id'=>'required',

            'photo1'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo2'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo3'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo4'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo5'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo6'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo7'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo8'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo9'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo10'=>'image|mimes:jpeg,png,jpg|max:500'
        ]);
      }else{
        $request->validate([
            // 'sd_id'=>'required',
            // 'tsh_id'=>'required',
            'shop_name'=>'required',
            'owner'=>'required',
            'fuel_type'=>'required',
            'storage'=>'required',
            'location'=>'required',
            'licence_id'=>'required',

            'photo1'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo2'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo3'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo4'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo5'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo6'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo7'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo8'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo9'=>'image|mimes:jpeg,png,jpg|max:500',
            'photo10'=>'image|mimes:jpeg,png,jpg|max:500'
        ]);
      }
       
       
      DB::beginTransaction();
      try {
          

      $shop = MachineOil::findOrFail($id);

        $path= "uploads/cars/".$request->licence_no;

        if($shop->path!=''){
          $path= $shop->path;
        }

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        $photo1=$shop->photo1;
        if($request->file('photo1')!=NULL){
          $file = $request->file('photo1');
          $extension = $file->getClientOriginalExtension();
          $photo1='photo1_'.date('d-m-Y-H-i-s').'.' . $extension;
          $file->move($path, $photo1);
        }


        $photo2=$shop->photo2;
        if($request->file('photo2')!=NULL){
            $file = $request->file('photo2');
            $extension = $file->getClientOriginalExtension();
            $photo2='photo2_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $photo2);          
        }

        $photo3=$shop->photo3;
        if($request->file('photo3')!=NULL){
            $file = $request->file('photo3');
            $extension = $file->getClientOriginalExtension();
            $photo3='photo3_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $photo3);          
        }


        $photo4=$shop->photo4;
        if($request->file('photo4')!=NULL){
          $file = $request->file('photo4');
          $extension = $file->getClientOriginalExtension();
          $photo4='photo4_'.date('d-m-Y-H-i-s').'.' . $extension;
          $file->move($path, $photo4);
        }


        $photo5=$shop->photo5;
        if($request->file('photo5')!=NULL){
            $file = $request->file('photo5');
            $extension = $file->getClientOriginalExtension();
            $photo5='photo5_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $photo5);          
        }

        $photo6=$shop->photo6;
        if($request->file('photo6')!=NULL){
          $file = $request->file('photo6');
          $extension = $file->getClientOriginalExtension();
          $photo6='photo6_'.date('d-m-Y-H-i-s').'.' . $extension;
          $file->move($path, $photo6);
        }


        $photo7=$shop->photo7;
        if($request->file('photo7')!=NULL){
            $file = $request->file('photo7');
            $extension = $file->getClientOriginalExtension();
            $photo7='photo7_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $photo7);          
        }

        $photo8=$shop->photo8;
        if($request->file('photo8')!=NULL){
            $file = $request->file('photo8');
            $extension = $file->getClientOriginalExtension();
            $photo8='photo8_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $photo8);          
        }


        $photo9=$shop->photo9;
        if($request->file('photo9')!=NULL){
          $file = $request->file('photo9');
          $extension = $file->getClientOriginalExtension();
          $photo9='photo9_'.date('d-m-Y-H-i-s').'.' . $extension;
          $file->move($path, $photo9);
        }


        $photo10=$shop->photo10;
        if($request->file('photo10')!=NULL){
            $file = $request->file('photo10');
            $extension = $file->getClientOriginalExtension();
            $photo10='photo10_'.date('d-m-Y-H-i-s').'.' . $extension;
            $file->move($path, $photo10);          
        }

        $user_id='';
        if(auth()->user()->role_id==1){
          if($shop->user_id!=null){
            $user = User::find($shop->user_id);
            $arr=[
                  'role_id'=>2, 
                  'sd_id'=>$request->sd_id,
                  'loginId'=>$request->licence_no,
                  'name'=>$request->shop_name,
                  'password'=>Hash::make($request->password)
                ];

            $user->fill($arr)->save();
            $user->assignRole("Shop Owner");
            $user_id=$user->id;
          }else{
              $user = User::create(
                [
                  'role_id'=>2,
                  'sd_id'=>$request->sd_id,
                  'loginId'=>$request->licence_no,
                  'name'=>$request->shop_name,
                  'password'=>Hash::make($request->password)
                ]
              );
              $user_id=$user->id;
              $user->assignRole("Shop Owner");
          }
        }else{
            $user = User::where("loginId",$shop->licence_no)->get();
            // dd();
            if($user->count()>0){
              $user = User::find($user[0]->id);
              $arr=[
                    'role_id'=>2, 
                    'sd_id'=>$request->sd_id,
                    'loginId'=>$request->licence_no,
                    'name'=>$request->shop_name,
                    'password'=>Hash::make('123456')
                  ];

              $user->fill($arr)->save();
              $user_id=$user->id;
              $user->assignRole("Shop Owner");
            }else{

               $user = User::create(
                [
                  'role_id'=>2,
                  'sd_id'=>$request->sd_id,
                  'loginId'=>$request->licence_no,
                  'name'=>$request->shop_name,
                  'password'=>Hash::make($request->password)
                ]
              );
              $user_id=$user->id;
              $user->assignRole("Shop Owner");
          }
        }
        

        $arr=[
              'user_id'=>$user_id, 
              'sd_id'=>$request->sd_id,
              'tsh_id'=>$request->tsh_id,
              'shop_name'=>$request->shop_name,
              'owner'=>$request->owner,
              'licence_no'=>$request->licence_no,
              'fuel_type'=>$request->fuel_type,
              'gasoline'=>$request->gasoline,
              'diesel'=>$request->diesel,
              'diesel'=>$request->diesel,
              'storage'=>$request->storage,
              'issue_date'=>($request->issue_date)?$request->issue_date:NULL,
              'expire_date'=>$request->expire_date,
              'location'=>$request->location,
              'lat'=>$request->lat,
              'lng'=>$request->lng,
              'licence_id'=>($request->lic_name_id)?$request->lic_name_id:'',
              'lic_grade_id'=>($request->lic_grade_id)?$request->lic_grade_id:'',
              'company_no'=>($request->company_no)?$request->company_no:'',
              'ph_no'=>$request->ph_no,
              'email'=>$request->email,
              'licence_id'=>$request->licence_id,
              'photo1'=>$photo1,
              'photo2'=>$photo2,
              'photo3'=>$photo3,
              'photo4'=>$photo4,
              'photo5'=>$photo5,
              'photo6'=>$photo6,
              'photo7'=>$photo7,
              'photo8'=>$photo8,
              'photo9'=>$photo9,
              'photo10'=>$photo10,
              'path'=>$path
            ];

          $shop->fill($arr)->save();

         DB::commit();
      } catch (\Exception $e) {
        dd($e);
          DB::rollback();
          return redirect()->route('admin.machine_oil.index')->with('error',$e->getMessage());
      }


      if(auth()->user()->role_id==2){
        return redirect()->route('myshop.index')->with('success','Data Update successfully');
      }else{
        return redirect()->route('admin.machine_oil.index')->with('success','Data Update successfully');  
      }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = MachineOil::find($id);

        $photo1 = public_path() .'/'. $shop->path.'/'.$shop->photo1;

        if (File::exists($photo1)) {
            File::delete($photo1);
        }

        $photo2 =public_path() .'/'. $shop->path.'/'.$shop->photo2;
        if (File::exists($photo2)) {
            File::delete($photo2);
        }

        $photo3 =public_path() .'/'. $shop->path.'/'.$shop->photo3;
        if (File::exists($photo3)) {
            File::delete($photo3);
        }

        $photo4 =public_path() .'/'. $shop->path.'/'.$shop->photo4;
        if (File::exists($photo4)) {
            File::delete($photo4);
        }

        $photo5 =public_path() .'/'. $shop->path.'/'.$shop->photo5;
        if (File::exists($photo5)) {
            File::delete($photo5);
        }

      $res= $shop->delete();

      return redirect()->back()->with('success','Deleted!');

    }

    public function print($id)
    {
      $shop = MachineOil::find($id);
      $hashids = new Hashids('', 10); // pad to length 10
      $hashids = $hashids->encodeHex($shop->id); 
      return view('admin.machine_oil.print',compact('shop','hashids'));
    }

    public function oldshowqrdata($id)
    {
      $shop = MachineOil::find($id);
      return view('frontend.shopqrdata',compact('shop'));
    }

    public function showqrdata($hashid)
    {
      $hashids = new Hashids('', 10); // pad to length 10
      $id = $hashids->decodeHex($hashid); 
      $shop = MachineOil::find($id);
      return view('frontend.shopqrdata',compact('shop'));
    }

    public function getTownshipByStateDivision(Request $request)
    {

        $statedivisionid = $request->state_division_id;
        if(isset($statedivisionid) && $statedivisionid!=''){
            $townships = Township::where('sd_id','=',$statedivisionid)->get();
            echo "<option value=''>မြို့နယ်ရွေးချယ်ပါ</option>";

            foreach ($townships as $t) {
                echo "<option value='".$t->id."' {{ (old('tsh_id')==".$t->id.")?'selected':'' }} >". $t->tsh_name_mm."</option>";
            }
            
            
        }
    }

    public function getSelect2Ajax(Request $request)
    {
        $sd_id = $request->sd_id;
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data =Township::select("id","tsh_name_mm")
                ->where('sd_id','=',$sd_id)
                ->where('tsh_name_mm','LIKE',"%$search%")
                ->orwhere('tsh_name_en','LIKE',"%$search%")
                ->get();
        }else{
           $data= Township::select("id","tsh_name_mm")->where('sd_id','=',$sd_id)->get();
        }
        return response()->json($data);
    }

    public function myShop()
    {
      $userid = auth()->user()->id;
      $shop = MachineOil::where('user_id',$userid)->get();
      $shop = $shop[0];
      return view('admin.machine_oil.ownershop',compact('shop'));
    }

    public function signage()
    {
      $userid = auth()->user()->id;
      $shop = MachineOil::where('user_id',$userid)->get();
      $shop = $shop[0];
      return view('admin.machine_oil.signage',compact('shop'));
    }

    public function downloadQrCode($id)
    {

        $this->generateShopQR($id);

        $shop = MachineOil::findOrFail($id);
        $strpath = public_path().'/'.$shop->path."/qrcode.png";

        $myFile = str_replace("\\", '/', $strpath);
        $headers = ['Content-Type: application/*'];
        $newName = $shop->licence_no.'qrcode.png';


        return response()->download($myFile, $newName, $headers);
    }


    public function generateShopQR($id)
    {
        $shop = MachineOil::findorfail($id);
        $destinationPath = public_path() .'/'. $shop->path . '/';

        if (!File::isDirectory($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
        }

        if (File::exists($destinationPath . 'qrcode.png')) {
            File::delete($destinationPath . 'qrcode.png');
        }

        $hashids = new Hashids('', 10); // pad to length 10
        $hashids = $hashids->encodeHex($shop->id); 

        $qrcode = QrCode::backgroundColor(255, 255, 0)->color(255, 0, 127)
            ->format('png')->size(500)
            ->generate(URL::to('/') . '/' . $hashids.'/s', $destinationPath . 'qrcode.png');

        return;
    }

    public function printSignage($id)
    {
      $shop = MachineOil::findorfail($id);
      return view('admin.machine_oil.print-signage',compact('shop'));

    }

    public function downloadPSD()
    {
        
        $strpath = public_path().'/uploads/files/PPRD Signate.psd';

        $isExists = File::exists($strpath);

        if(!$isExists){
            return redirect()->back()->with('error','File does not exists!');
        }

        $csvFile = str_replace("\\", '/', $strpath);
        $headers = ['Content-Type: application/*'];
        $fileName = 'Signate.psd';

        return response()->download($csvFile, $fileName, $headers);
    }

    public function saveCanvas(Request $request)
    {

        $shop = MachineOil::find($request->shop_id);
        $photo2 = $shop->photo2;
        $path = $shop->path;
  

        $destinationPath = public_path() .'/'. $shop->path . '/';

        if (!File::isDirectory($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
        }

        if ($request->image){
          $image = $request->input('image'); // image base64 encoded
          preg_match("/data:image\/(.*?);/",$image,$image_extension); // extract the image extension
          $image = preg_replace('/data:image\/(.*?);base64,/','',$image); // remove the type part
          $image = str_replace(' ', '+', $image);
          $photo2 = $shop->licence_no . '.' . $image_extension[1]; //generating unique file name;
          \File::put( $destinationPath.$photo2,base64_decode($image));
      }



      $arr=[
        'photo2'=>$photo2
      ];

      $shop->fill($arr)->save();

 
    }

    public function downloadJPG($id)
    {
        $userid = auth()->user()->id;
        $shop = MachineOil::find($id);
        $strpath = public_path().'/'.$shop->path.'/'.$shop->photo2;
        $isExists = File::exists($strpath);

        if($shop->photo2 =='' || $shop->photo2 ==null){
          return redirect()->back()->with('error','File does not exists!');
        }
       
        if(!$isExists){
            return redirect()->back()->with('error','File does not exists!');
        }



        $file = str_replace("\\", '/', $strpath);
        $headers = ['Content-Type: application/*'];
        $fileName = 'signage.jpg';

        return response()->download($file, $fileName, $headers);
    }

    public function changePassword(Request $request)
    {   

        $request->validate([
            'password' => ['required', 'string', 'min:6'],
        ]);
        $id = $request->user_id;
        $user = User::find($id);
        $password = $request->get('password');
        $user->email = $request->email;
        $user->password = Hash::make($password);
        $user->save();

        return redirect()->route('admin.machine_oil.index')
                        ->with('success','Password change successful!');
    }

    public function machine_oil(Request $request)
    {
      $sdivisions = StateDivision::all();

      $townships = new Township();

      $fuel_types = DB::table('machine_oil')
                 ->select('fuel_type')
                 ->groupBy('fuel_type')
                 ->get();
      // dd($fuel_types);

      if(auth()->user()->role_id==3){
        $townships = $townships->where('sd_id',auth()->user()->sd_id)->get();
      }

      $townships = $townships->all();

      $data = new MachineOil();

      $keyword = $request->keyword;

      if($keyword!=''){
        $data = $data->where('shop_name','like','%'.$keyword.'%')->orWhere('owner','like','%'.$keyword.'%')->orWhere('licence_no','like','%'.$keyword.'%');
      }

      $fuel_type = $request->fuel_id;

      if($fuel_type!=''){
        $data = $data->where('fuel_type','like','%'.$fuel_type.'%');
      }

      $sd_id = $request->sd_id;
      if(auth()->user()->role_id==3){
        $sd_id = auth()->user()->sd_id;
      }

      if($sd_id!=''){
        $data = $data->where('sd_id',$sd_id);
      }

      $tsh_id = $request->township_id;
      if($tsh_id!=''){
        $data = $data->where('tsh_id',$tsh_id);
      }

      $count = $data->where('licence_id',3)->get()->count();

      $shops = $data->where('licence_id',3)->orderBy('created_at','desc')->paginate(10);

      return view('admin.machine_oil.index',compact('shops','count','sdivisions','townships','fuel_types'));
    }
    

    
}

