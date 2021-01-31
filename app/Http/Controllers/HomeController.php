<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        if (auth()->user()->is_admin == 1) {
            // return redirect()->route('admin.home');
            $catagory = DB::table('quiz_catagories')->get();
            return view('adminHome',['catagorys'=>$catagory]);
            
        }else{
            $catagory = DB::table('quiz_catagories')->get();
            return view('home',['catagorys'=>$catagory]);
        }
        ;
    }
    
    public function adminHome()
    {
        // $catagory = DB::table('quiz_catagories')->get();
        // return view('adminHome',['catagorys'=>$catagory]);
        return "Hii";
       
    }
}
