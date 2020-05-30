<?php

namespace App\Http\Controllers;

use App\Result;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


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
        $allResults = DB::table('results')->select(DB::raw('count(date) as count,date'))->groupBy('date')->get();
        return view('home', [
            'allResults' => $allResults
        ]);
    }

    public function showResult(Request $request,$date)
    {
        if ($request->has('test'))
        {
            $message=Result::find($request->id);
            $message->message=$request->message;
            $message->save();
            Session::flash('message', 'Комментарий обновлён');

        }
        $allData = Result::all();
        $allDataToday=$allData->where('date',$date);
        $id=Auth::id();
        return view('result.show', [
            'allData'=>$allData,
            'allDataToday'=>$allDataToday,
            'date'=>$date,
            'id'=>$id
        ]);
    }
}
