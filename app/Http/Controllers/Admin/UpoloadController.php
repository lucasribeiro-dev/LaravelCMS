<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UpoloadController extends Controller
{
    public function imageupload(Request $request){
        $request->validate([
            'file' => 'required|image|mimes:jpeg,jpg,png',
        ]);
        
        $ext = $request->file->extension();
        $imageName = time().'.'.$ext;

        $request->file->move(public_path('media/images'), $imageName);
        
        return[
            'location' => asset('media/images/'.$imageName)
        ];
    }
}
