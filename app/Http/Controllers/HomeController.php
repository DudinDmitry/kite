<?php

namespace App\Http\Controllers;

use App\Result;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allResults=DB::table('results')->select(DB::raw('count(date) as count,date'))->groupBy('date')->get();
        return view('home',[
            'allResults'=>$allResults
        ]);

    }
}
