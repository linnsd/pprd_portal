<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\StateDivision;
use App\Township;
use Hash;
use Mail;
use Spatie\Permission\Models\Role;
use DB;

class UserController extends Controller
{

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $stdivisions = StateDivision::all();
        $users = new User();

        $keyword=$request->keyword;
        if($keyword!=''){
            $users=$users->where('name','like','%'.$keyword.'%');
        }

        $sd_id=$request->sd_id;
        if($sd_id!=''){
            $users=$users->where('sd_id',$sd_id);
        }

        $users=$users->orderby('created_at','desc')->paginate(20);
        return view('admin.users.index',compact('users','stdivisions'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $statedivisions = StateDivision::all();
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.create',compact('statedivisions','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $rules=[
              'roles' => 'required',
              'state_division_id'=> 'required',
              'name'=> 'required',
              'loginId' =>'required|unique:users,email',
              'password' => ['required', 'string', 'min:4', 'confirmed'],
        ];
        
        $validate = $this->validate($request, $rules);

        $user = User::create([
                    'role_id'=> 2,
                    'sd_id' =>  $request->state_division_id,
                    'name' =>$request->name,
                    'loginId' => $request->loginId,
                    'password' => Hash::make($request->password),
                   
                ]);

        $user->assignRole($request->input('roles'));


        // $user->password =$request->password;

        // if($request->email!=''){
        //     Mail::send('emails.collaboratorEmail', ['user' => $user], function ($m) use ($user) {
        //             $m->from('office@myanmarmia.org', 'MMIA');
        //             $m->to($user->email, $user->name_en)
        //               ->subject(' Grand Access Mail From MMIA ');
        //         });
        // }
          return redirect()->route('admin.users.index')
                        ->with('success','User account created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $member = User::find($id);
        return view('admin.users.show',compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {   
        $statedivisions = StateDivision::all();
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('admin.users.edit',compact('user','statedivisions','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user = User::find($id);

        if($request->role_id==1){
            if($user->password==''){
                    $request->validate([
                        'roles' => 'required',
                        'name'=> 'required',
                        'loginId' =>'required',
                    ]);
                }else{
                    $request->validate([
                       'roles' => 'required',
                        'name'=> 'required',
                        'loginId' =>'required',
                    ]);
                }
        }else{
            if($user->password==''){
                $request->validate([
                    'roles' => 'required',
                    'sd_id'=> 'required',
                    'name'=> 'required',
                ]);
            }else{
                $request->validate([
                    'roles' => 'required',
                    'sd_id'=> 'required',
                    'name'=> 'required',
                    'loginId' =>'required',
                ]);
            }
        }

        

        if($request->password==''){
             $user = $user->update([
                    // 'role_id'=> $request->role_id,
                    'sd_id' =>  $request->sd_id,
                    // 'email' =>  $request->email,
                    'name' =>$request->name,
                    'loginId' => $request->loginId,
                   
                ]);
        }else{
             $user = $user->update([
                    // 'role_id'=> $request->role_id,
                    'sd_id' =>  $request->sd_id,
                    'loginId' =>  $request->loginId,
                    'name' =>$request->name,
                    'password' => Hash::make($request->password),
                ]);
        }

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user = User::findorfail($id);
        $user->assignRole($request->input('roles'));

       
        return redirect()->route('admin.users.index')
                        ->with('success','Collaborator updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
  
        return redirect()->route('admin.users.index')
                        ->with('success','Collaborator deleted successfully');
    }

    public function setShopOwnerRole(){

        try{
            $users = User::orderby('created_at','desc')->get();

           app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();


            foreach ($users as $key => $usr) {
                $count = count($usr->getRoleNames()->toArray());
                if($count==0){
                   // $user = User::find($usr->id);
                    DB::table('model_has_roles')->where('model_id',$usr->id)->delete();

                    $usr->assignRole('Shop Owner');
                }
            }
        }catch(\Exception $e){
            dd($e);
             return redirect()->route('admin.users.index')
                        ->with('error','Something went wrong!');
        }

        return redirect()->route('admin.users.index')
                        ->with('success','Role Update successfully');
       

       
    }

    public function changestatususer(Request $request)
    {
        $users = User::find($request->user_id);
        $users->status = $request->status;

        $users->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
}
