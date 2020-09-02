<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('can:edit-users');
    }

    public function index(){
        //Show settings in index
        $settings = [];

        $dbsettings = Setting::get();

        foreach($dbsettings as $dbsetting){
            $settings[$dbsetting['name']] = $dbsetting['content'];
        }
        return view('admin.settings.index', ['settings' => $settings]);
    }
    public function update(Request $request){
        //Get and verify datas in setting
        $data = $request->only([
            'title', 'subtitle','email','bgcolor','textcolor'
        ]);
        
        $validator = $this->validator($data);

        if($validator->fails()){
            return redirect()->route('settings')->withErrors($validator);
        }

        //Change value in db
        foreach($data as $item => $value){
            Setting::where('name', $item)->update([
                'content' => $value
            ]);
        }
        return redirect()->route('settings')->with('warning', 'Data successfully edited');
    }

    protected function validator($data){
        return Validator::make($data, [
            'title' => ['string', 'max:100'],
            'subtitle' => ['string', 'max:100'],
            'email' => ['string', 'email'],
            'bgocolor' => ['string', 'regex:/#[A-Z0-9]{6}/i'],
            'textcolor' => ['string', 'regex:/#[A-Z0-9]{6}/i'],
        ]);
    }
}
