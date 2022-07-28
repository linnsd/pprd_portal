<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Auth;
use Redirect;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/home';

    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUserName();
    }

        /**
     * Account sign in.
     *
     * @return View
     */
    public function showLoginForm()
    {   
        // dd("Here");
        // Is the user logged in?
        if (Auth::check()) {
            return Redirect::route('admin.home');
        }

        // Show the page
        return view('vendor.adminlte.login');
    }



    public function findUserName()
    {
        $login = request()->input('email');


        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL)?'email':'loginId';

        request()->merge([$fieldType => $login ]);
        return $fieldType;
    }

    public function username()
    {
        return $this->username;
    }

    protected function validateLogin(Request $request)
    {       
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    
    }
    
    protected function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/admin');
    }

    public function showLinkRequestForm(){
         // Show the page
        return view('vendor.adminlte.passwords.email');
    }

    public function showResetForm(Request $request, $token = null)
    {   
        // Show the page
        return view('vendor.adminlte.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    /**
     * Get the needed authorization credentials from the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
     // protected function credentials(\Illuminate\Http\Request $request)
     // {
     //    $credentials = $request->only($this->username(), 'password');
     //    // dd($credentials);
     //    return array_add($credentials, 'status', 1);
     // }

     protected function credentials(Request $request) {
      return array_merge($request->only($this->username(), 'password'), ['status' => 1]);
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        // Load user from database
        $user = User::where($this->username(), $request->{$this->username()})->first();


        if($user!=null || $user!=''){
            // Check if user was successfully loaded, that the password matches
            // and active is not 1. If so, override the default error message.
            if ($user && \Hash::check($request->password, $user->password) && $user->active != 1) {
                return redirect()->back()
                            ->withInput($request->only($this->username(), 'remember'))
                            ->with(['error'=> 'This account has not been activated yet.']);
            }else{
                return redirect()->back()
                            ->withInput($request->only($this->username(), 'remember'))
                            ->with(['error'=> 'These credentials do not match our records.']);
            }
        }else{
            return redirect()->back()
                            ->withInput($request->only($this->username(), 'remember'))
                            ->with(['error'=> 'These credentials do not match our records.']);
        }
        
       
    }
    
}
