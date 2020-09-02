<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Visit;
use App\Page;
use App\User;
use App\Online;




class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){

        //count
        $visitsCount = 0;
        $onlineCount = 0;
        $pageCount = 0;
        $userCount = 0;
        $interval = intval($request->input('interval', 30));

        //Visit
       
        //Count of Visist   
        $dateInterval = date('Y-m-d H:i:s', strtotime('-'.$interval.'days'  ));
        $visitsCount = Visit::where('date_access', '>=', $dateInterval)->count();
        if($interval > 120){
            $interval = 120;
        }

        //Count of Online Users
        $datelimit = date('Y-m-d H:i:s', strtotime('-15 minutes'));
        $onlineList = Online::where('date_access', '>=', $datelimit)->get();
        if(!$onlineCount){
            $onlineCount = count($onlineList);
        }

        //Count of Pages
        $pageCount = Page::count();

        //Count of User
        $userCount = User::count();

        //Count for Chart
        $pagePie = [];
        $visitsAll = Visit::selectRaw('page, count(page) as c')->where('date_access', '>=', $dateInterval)->groupBy('page')->get();
        foreach($visitsAll as $visit){
            $pagePie[$visit['page']] = intval($visit['c']);
        }

        //Datas for Chart
        $pageLabels = json_encode( array_keys($pagePie));
        $pageValues = json_encode( array_values($pagePie));


        return view('admin.home', ['visits' => $visitsCount,
        'onlineUsers' => $onlineCount,
        'pages' => $pageCount,
        'users' => $userCount,
        'pageLabels' => $pageLabels,
        'pageValues' => $pageValues,
        'dateInterval' => $interval]);
    }
}
