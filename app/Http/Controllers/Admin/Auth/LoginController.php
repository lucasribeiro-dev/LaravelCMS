<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/panel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('admin.login');
    }

    //Making Login
    public function authenticate(Request $request){
        $data = $request->only([
            'email',
            'password',
        ]);

        $remember = $request->input('remember');

        $validator = $this->validator($data, false);

        if( $validator->fails() ){
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        if(Auth::attempt($data, $remember)){
            return redirect()->route('admin');
        } else{
            $validator->errors()->add('password', "Email or Password wrong");
            return redirect()->route('login')->withErrors($validator)->withInput();
        }
    }

    //Make Logout
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    //Validate Login
    public function validator(array $data){
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:100'],
            'password' => ['required', 'string', 'min:3']
        ]);
    }
}
