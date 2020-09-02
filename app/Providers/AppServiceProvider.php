<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Page;
Use App\Setting;
Use App\Visit;
Use App\Online;




class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {

        //Menu
        $frontMenu = [
            '/' => 'Home'
        ];
        $pages = Page::all();
        foreach ($pages as $page) {
            $frontMenu[ $page['slug']] = $page['title'];
        }        
        View::share('front_menu', $frontMenu);

        //Config 
        $config = [];
        $settings = Setting::all();
        foreach($settings as $setting){
            $config[$setting['name']] = $setting['content'];
        }
        View::share('front_config', $config);


        //Count visits 
        $p = substr($request->fullUrl(), 22); //Get the name of page

        $visit = new Visit;
        $visit->ip = $_SERVER["REMOTE_ADDR"] ?? '127.0.0.1';
        $visit->date_access = date('Y-m-d H:i:s');
        $visit->page = $p;
        $visit->save();

        //Online people
        $verify_online = Online::where('date_access', '<', date('Y-m-d H:i:s'))->where('ip', '=', $_SERVER["REMOTE_ADDR"] ?? '127.0.0.1')->delete();
        $online = new Online;
        $online->ip = $_SERVER["REMOTE_ADDR"] ?? '127.0.0.1';;
        $online->date_access = date('Y-m-d H:i:s');
        $online->save();

    }
}
