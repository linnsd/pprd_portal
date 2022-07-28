<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Redirect;
use File;
use Mail;
use App\Mail\Email;
use App\Mail\ContactMail;
use App\Mail\SentMailContact;
use App\Jobs\SendEmailContact;
use App\Jobs\SendEmailJob;
use App\Jobs\SendEmailReg;
use App\StateDivision;

class FrontendController extends Controller
{
    
    public function index()
    {   
     //    $event = Events::latest()->limit(1)->get();

     //    $countdown = '';
     //    if(isset($event)){
     //        $countdown  =  date("M d , Y", strtotime($event[0]->date)). ' ' .date("h:i:s",strtotime($event[0]->start_time));
     //    }else{
     //        $countdown = '';
     //    }
        
    	// $latest = Post::orderBy('publish_date','desc')->limit(3)->get();
        $latest=[];
        $event = [];
        $countdown= ''; 
        return view('frontend.index',compact('latest','event','countdown'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function news()
    {   
        $latest = Post::orderBy('publish_date','desc')->limit(5)->get();
        $posts = Post::orderBy('publish_date','desc')->paginate(10);
        return view('frontend.news',compact('posts','latest'));
    }

    public function newsdetail($id)
    {   
        $latest = Post::orderBy('publish_date','desc')->limit(5)->get();
        $post = Post::findorfail($id);
        return view('frontend.news-detail',compact('post','latest'));
    }

    public function login()
    {
        return view('frontend.login');
    }


    public function register()
    {   
        $statedivisions = StateDivision::all();
    	return view('frontend.register',compact('statedivisions'));
    }

    public function registerPost(Request $request)
    {

        $rules=[
              'name'=> 'required',
              'nrc'=> 'required',
              'email' => 'unique:register_users,email',
              'phone'=> 'required',
              'business_name' => 'required',
              'address'=> 'required',
              'state_division_id'=>'required',
        ];

         $customMessages = [
                'name.required'=> 'အမည္ ထည့္သြင္းရန္လိုအပ္ပါသည္',
                'nrc.required'=> 'မွတ္ပံုတင္နံပါတ္ ထည့္သြင္းရန္လိုအပ္ပါသည္',
                'email.unique' => 'အီးေမးလ္အသံုးျပဳျပီးသားျဖစ္ေသာေၾကာင့္ တစ္ျခားအီးေမးလ္ကို အသံုးျပဳပါ',
                'phone.required'=> 'ဖုန္းနံပါတ္ထည့္သြင္းရန္လိုအပ္ပါသည္',
                'business_name.required'=> 'ဆိုင္အမည္/ကုမၸဏီအမည္ ထည့္သြင္းရန္လိုအပ္ပါသည္',
                'address.required'=> 'ေနရပ္လိပ္စာ ထည့္သြင္းရန္လိုအပ္ပါသည္',
                'state_division_id.required'=> 'ျပည္နယ္/တိုင္း ေရြးခ်ယ္ေပးပါ',
        ];

         $this->validate($request, $rules, $customMessages);


        // $data = RegisterUser::orderBy('created_at', 'desc')->first();

        // $folder_name = '';

        // if (empty($data)) {
        //      $folder_name = '1';
        // }else{
        //     $folder_name = $data->id+'1';
        // }

        // $path = public_path().'/uploads/members/'. $folder_name.'/';
        // $pic = '';
        // if($request->get('pic')!=""){
            
        //     $file_data = $request->input('pic');
        //     $image = $request->input('pic');  // your base64 encoded
        //     $image = str_replace('data:image/png;base64,', '', $image);
        //     $image = str_replace(' ', '+', $image);
        //     $imageName = $folder_name."_pic".".jpg";
        //     // $path = $path. $imageName;
        //     $path = public_path().'/uploads/members/'. $imageName;
        //     $success = file_put_contents($path, base64_decode($image));
        //     $pic = $imageName;
        //  }
        //  else if ($file = $request->file('pic')) {
        //         $extension = $file->extension()?: 'png';
        //         $destinationPath = public_path() . '/uploads/members/';
        //         $safeName =  $request->file('pic')->getClientOriginalName();
        //         $file->move($destinationPath, $safeName);
        //         $pic = $safeName;
        // }else{                
        //        $pic='';
        // }

        // $nrc_front = '';
        // if($request->get('nrc_front')!=""){
            
        //     $file_data = $request->input('nrc_front');
        //     $image = $request->input('nrc_front');  // your base64 encoded
        //     $image = str_replace('data:image/png;base64,', '', $image);
        //     $image = str_replace(' ', '+', $image);
        //     $imageName = $folder_name."_nrc_front".".jpg";
        //     // $path = $path. $imageName;
        //     $path = public_path().'/uploads/members/'. $imageName;
        //     $success = file_put_contents($path, base64_decode($image));
        //     $nrc_front = $imageName;
        //  }
        //  else if ($file = $request->file('nrc_front')) {
        //         $extension = $file->extension()?: 'png';
        //         $destinationPath = public_path() . '/uploads/members/';
        //         $safeName =  $request->file('nrc_front')->getClientOriginalName();
        //         $file->move($destinationPath, $safeName);
        //         $nrc_front = $safeName;
        // }else{                
        //        $nrc_front='';
        // }


        // $nrc_back = '';
        // if($request->get('nrc_back')!=""){
            
        //     $file_data = $request->input('nrc_back');
        //     $image = $request->input('nrc_back');  // your base64 encoded
        //     $image = str_replace('data:image/png;base64,', '', $image);
        //     $image = str_replace(' ', '+', $image);
        //     $imageName = $folder_name."_nrc_back".".jpg";
        //     // $path = $path. $imageName;
        //     $path = public_path().'/uploads/members/'. $imageName;
        //     $success = file_put_contents($path, base64_decode($image));
        //     $nrc_back = $imageName;
        //  }
        //  else if ($file = $request->file('nrc_back')) {
        //         $extension = $file->extension()?: 'png';
        //         $destinationPath = public_path() . '/uploads/members/';
        //         $safeName =  $request->file('nrc_back')->getClientOriginalName();
        //         $file->move($destinationPath, $safeName);
        //         $nrc_back = $safeName;
        // }else{                
        //        $nrc_back='';
        // }
       
        $user = RegisterUser::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'nrc'=> $request->nrc,
                'phone'=> $request->phone,
                'address'=> $request->address,
                'business_name'=> $request->business_name,
                'state_division_id'=> $request->state_division_id,
                'township'=> $request->township,
                
            ]);


        if($request->email!=''){

            \Mail::to($user)->send(new Email);
            // dispatch(new SendEmailReg($user));
        }

        if($user->email==''){
            $user->email ='office@myanmarmia.org';
        }

        // dispatch(new SendEmailJob($user));
   
        Mail::send('emails.memberemail', ['user' => $user], function ($m) use ($user) {
                    $m->from($user->email, $user->name);
                    $m->to('office@myanmarmia.org', 'MMIA')
                      ->subject('Registration received from MMIA');
                }); 
  
        



        return Redirect::route('register.complete',$user->id)->with( ['user' => $user] );
                       
    }

    public function registerComplete($id)
    {
         $user = RegisterUser::findorfail($id);
          return view('frontend.register_success',compact('user'));
    }


    public function getTownshipByStateDivision(Request $request)
    {
        $statedivisionid = $request->state_division_id;
        if(isset($statedivisionid) && $statedivisionid!=''){
            $townships = Township::where('state_division_id','=',$statedivisionid)->get();
            echo "<option value=''>ျမိဳ့နယ္ေရြးခ်ယ္ပါ</option>";

            foreach ($townships as $t) {
                echo "<option value='".$t->id."' {{ (old('township_id')==".$t->id.")?'selected':'' }} >". $t->tsh_name."</option>";
            }
            
            
        }
    }

    public function contactPost(Request $request)
    {
        $rules=[
              'name'=> 'required',
              'subject'=> 'required',
              'message' => 'required',
        ];

         $this->validate($request, $rules);

        $user = Contact::create([
                'name'=> $request->name,
                'email' => $request->email,
                'subject'=>$request->subject,
                'message'=>$request->message,
                
            ]);

        if($request->email!=''){

            \Mail::to($user)->send(new ContactMail);
            // dispatch(new SendEmailContact($user));
        }

        if($user->email==''){
            $user->email ='office@myanmarmia.org';
        }

        // dispatch(new SendEmailJob($user));
   
        Mail::send('emails.contactEmail', ['user' => $user], function ($m) use ($user) {
                    $m->from($user->email, $user->name);
                    $m->to('office@myanmarmia.org', 'MMIA')
                      ->subject('Receiving  Mail From Contact : ' . $user->name);
                }); 

        return redirect()->back()->with('success','Thanks for contacting us!');      

    }
}
