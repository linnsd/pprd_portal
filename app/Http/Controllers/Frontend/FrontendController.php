<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Township;
use App\User;
use App\Committee;
use App\Business;
use Auth;
use File;
use Hash;

class FrontendController extends Controller
{
    public function home()
    {   
        return view('frontend.home');
    }


    public function about()
    {   
        $committees = Committee::limit(3)->get();
        return view('frontend.about',compact('committees'));
    }

    public function member()
    {  
        $committees = Committee::all();
        $members = User::where('role_id','!=',1)->get();
    	return view('frontend.member',compact('committees','members'));
    }

    public function news()
    {
    	return view('frontend.news');
    }

    public function committee()
    {
    	return view('frontend.committee');
    }

    public function contactus()
    {
    	return view('frontend.contact');
    }

    public function profile(Request $request)
    {   
        $townships = Township::all();

        $loginuser_id = Auth::user()->id;
        $member_admin = User::where('id',$loginuser_id)->get();

        $admin_township = $member_admin[0]->msme_5;

  
        $check_member_admin = Auth::user()->role_id;

        
        $businesses = new Business();
        $businesses = Business::with('member')->where('user_id',$loginuser_id)->orderBy('created_at','desc')->paginate(10);

        return view('frontend.profile',compact('businesses','townships','member_admin'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function register()
    {   
        $townships = Township::all();
        return view('frontend.business_register',compact('townships'));
    }

    public function updateProfile(Request $request,$id)
    {   


         $rules=[
              // 'role_id'=> 'required',
              'name_mm'=> 'required',
              'name_en'=> 'required',
              'nrc_mm'=> 'required',
              'nrc_en'=> 'required',
              // 'township_id'=> 'required',
              'address'=> 'required',
              'gender'=> 'required',
              // 'dob'=> 'required',
              // 'email'=> 'required',
              // 'phone' => ['required', 'digits:11','unique:users'],
              // 'password' => ['required', 'string', 'min:4', 'confirmed'],
        ];

        
        $customMessages = [
            // 'role_id.required' => 'Please select member role!',
            'gender.required' => 'Please select gender!',
            'name_mm.required' => 'လုပ်ငန်းရှင်/ကုမ္ပဏီအမည် (မြန်မာ) ထည့်သွင်းပါ',
            'name_en.required' => 'လုပ်ငန်းရှင်/ကုမ္ပဏီအမည် (အင်္ဂလိပ်) ထည့်သွင်းပါ',
            'nrc_mm.required' => 'နိုင်ငံသားစီစစ်ရေးကဒ်ပြားအမှတ် (မြန်မာ) ထည့်သွင်းပါ',
            'nrc_en.required' => 'နိုင်ငံသားစီစစ်ရေးကဒ်ပြားအမှတ် (အင်္ဂလိပ်) ထည့်သွင်းပါ',
            // 'township_id.required' => 'မြို့နယ် ရွှေးချယ်ပါ',
            'address.required' => 'နေရပ်လိပ်စာ ထည့်သွင်းပါ',
            // 'email.required' => 'required',
            // 'dob.required' => 'Date of birth is required!',
            'phone.required' => 'ဖုန်းနံပါတ် ထည့်သွင်းပါ',
           
        ];

        $validate = $this->validate($request, $rules, $customMessages);
        
        $member = User::find($id);

        $photo = "";
        //upload image
        if ($file = $request->file('photo')) {
            $extension = $file->getClientOriginalExtension();
            $destinationPath = public_path() . '/uploads/member/';
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);

            //delete old pic if exists
            if (File::exists($destinationPath . $member->photo)) {
                File::delete($destinationPath . $member->photo);
            }

            $photo = $safeName;
        }

        $member = $member->update([
            // 'role_id'=> $request->role_id,
            'email' => ($request->email)?$request->email:'',
            'name_en' => $request->name_en,
            'name_mm' => $request->name_mm,
            'nrc_mm' => $request->nrc_mm,
            'nrc_en' => $request->nrc_en,
            'dob' => ($request->dob)?$request->dob:'',
            'gender' => ($request->gender)?$request->gender:'',
            // 'township_id' =>$request->township_id,
            'address' => $request->address,
            // 'phone' => $request->phone,
            // 'password' =>Hash::make($request->password),
            // 'photo' => $photo,
            // 'status' => ($request->status)?$request->status:'0'
        ]);

        return redirect()->route('profile')
                        ->with('success','Profiel updated successfully');
    }

    public function updateAvatar(Request $request,$id)
    {   
        
        $member = User::find($id);

        $photo = "";
        //upload image
        if ($file = $request->file('photo')) {
            $extension = $file->getClientOriginalExtension();
            $destinationPath = public_path() . '/uploads/member/';
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);

            //delete old pic if exists
            if (File::exists($destinationPath . $member->photo)) {
                File::delete($destinationPath . $member->photo);
            }

            $photo = $safeName;
        }

        $member = $member->update([
            'photo' => $photo
        ]);

        return redirect()->route('profile')
                        ->with('success','Profiel picture successfully');
    }

    public function resetPassword(Request $request,$id)
    {   
        
        $request->validate([
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);


        $user = User::find($id);
        $password = $request->get('password');
        $user->password = Hash::make($password);
        $user->save();

        return redirect()->route('profile')
                        ->with('success','Password reset successful!');
    }

    
}
