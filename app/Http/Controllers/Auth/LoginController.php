<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }
    public function adminLogin(){
        return view('adminLogin');
    }
    public function userLogin(){
        return view('userLogin');
    }
    public function adminLoginAction(Request $request){
         $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
            
        ]);
        if ($this->guardLogin($request,'Admin')) {

            return redirect()->intended('/admin');
        }
        return back()->withInput($request->only('email', 'remember'))->with('error', 'Email and Password not match. Please check and try with correct.');
    }
    public function userLoginAction(Request $request){
        //dd($request);
         $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($this->guardLogin($request, 'web')) {

            return redirect()->intended('/home');
        }
        return back()->withInput($request->only('email', 'remember'))->with('error', 'Email and Password not match. Please check and try with correct.');
    }
    protected function guardLogin(Request $request, $guard)
    {
        //dd($request);

         

            return Auth::guard($guard)->attempt(
                [
                    'email' => $request->email,
                    'password' => $request->password,
                ],
                $request->get('remember')
            );
        

    }
    public function admin_logout(Request $request)
    {
        if (Auth::guard('Admin')->check()) // this means that the admin was logged in.
        {
            Auth::guard('Admin')->logout();
            return redirect()->route('adminlogin');
        }

        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/admin/login');
}
public function user_logout(Request $request)
{
    if (Auth::guard('web')->check()) // this means that the admin was logged in.
    {
        Auth::guard('web')->logout();
        return redirect()->route('userLogin');
    }

    $this->guard()->logout();
    $request->session()->invalidate();

    return $this->loggedOut($request) ?: redirect('/user/login');
}


}