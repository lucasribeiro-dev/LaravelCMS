<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Page;
use Illuminate\Support\Str;


class PageController extends Controller
{
  
    public function __construct(){
        $this->middleware('auth');
    } 
    public function index()
    {
        $pages = Page::paginate(10);
        
        return view('admin.pages.index', ['pages' =>$pages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Page;

        $data = $request->only([
            'title',
            'body',
        ]);

        $data['slug'] = Str::slug($data['title'], '-');

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:100'],
            'slug' => ['string', 'max:100', 'unique:pages'],
            'body' => ['string'],
        ]);
        
        if($validator->fails() ){
            return redirect()->route('pages.create')->withErrors($validator)->withInput();
        }

        $page->title = $data['title'];
        $page->slug = $data['slug'];
        $page->body = $data['body'];
        $page->save();
        
        return redirect()->route('pages.index')->with('warning', 'Page successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        if($page){
        return view('admin.pages.edit', ['page'=>$page]);

        }
        return redirect()->route('pages.index');
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
        $page = Page::find($id);

        if($page){
             $data = $request->only([
            'title',
            'body',
            'slug',
        ]);

        //Verify if the title was modified if was modified change the slug and if this slug already exists add a random number
        if($page['title'] !== $data['title']){
            $data['slug'] = Str::slug($data['title'], '-');
            $hasSlug = Page::where('slug', $data['slug'])->get();
            if(count($hasSlug) > 0 ){
                $data['slug'] = Str::slug($data['title'], '-');
                 $data['slug'] = $data['slug'].'-'.rand(0,9999);
                }
            
            $validator = Validator::make($data,[
                'title' => ['required', 'string', 'max:100'],
                'slug' => ['string', 'max:100'],
                'body' => ['string', 'max:65535'],
            ]);

        }else{
            $validator = Validator::make($data,[
                    'title' => ['required', 'string', 'max:100'],
                    'body' => ['string', 'max:65535'],
                ]);
            }
        
        //Verify Errors
        if(count($validator->errors()) > 0 ){
            return redirect()->route('pages.edit', $id)->withErrors($validator)->withInput();
        }

        //Edit and Save
        $page->title = $data['title'];
        $page->body = $data['body'];
        $page->slug = $data['slug'];
        $page->save();       
        }
       
        return redirect()->route('pages.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::find($id)->delete();
        return redirect()->route('pages.index');
    }           
}
