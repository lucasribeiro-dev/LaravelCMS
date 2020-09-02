<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;



class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    } 

    public function index(Request $request){

        $loggedId = intval(Auth::id());
        $user = User::find($loggedId);
        return view('admin.profile.index', ['user' => $user] );
    }

    public function update(Request $request)
    {
        $loggedId = intval(Auth::id());
        $user = User::find($loggedId);

        if($user){
             $data = $request->only([
            'name',
            'email',
            'password',
            'password_confirmation'
        ]);

        $validator = Validator::make([
            'name'=> $data['name'],
            'email'=> $data['email'],
        ],
        [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100'],
        ]);
        
        //Edit Name
        $user->name = $data['name'];

        //Edit Email
        if($user->email != $data['email']){
            $hasEmail = User::where('email', $data['email'])->get();
            if(count($hasEmail) > 0 ){
                $validator->errors()->add('email', __('validation.unique', ['attribute' => 'email']) );

            }else{
                $user->email = $data['email'];
            }
        }
        
        //Edit password
        if(!empty($data['password'])){
            if(strlen($data['password']) >= 3){
                if($data['password'] === $data['password_confirmation']){
                    $user->password = Hash::make($data['password']);
                }else{
                    $validator->errors()->add('password', __('validation.confirmed', ['attribute' => 'password']) );

                }
            }else{
                $validator->errors()->add('password', __('validation.min.string', ['attribute' => 'password', 'min' => 3]) );
            }
           
        }

        //Verify Errors
        if(count($validator->errors()) > 0 ){
            return redirect()->route('profile', loggedId)->withErrors($validator)->withInput();
        }

        $user->save();       
        }
        return redirect()->route('profile')->with('warning', 'Data successfully edited');

       
        
        return redirect()->route('profile');
    
    }
}
