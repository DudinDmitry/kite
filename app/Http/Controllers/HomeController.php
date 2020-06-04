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
        $allResults = DB::table('results')->select(DB::raw('count(date) as count,date'))
            ->where('published','=',1)->orderBy('date','desc')->groupBy('date')->get();

        /* setlocale(LC_ALL, 'ru_RU.UTF-8');
         $newarr=[];
         foreach ($allResults as $allResult) {
            $newarr[]= strftime('%e %B %Y',strtotime($allResult->date));
         }
         $test = strtotime($allResults[0]->date);
         $test = strftime('%e %B %Y', $test);*/
        return view('home', [
            'allResults' => $allResults,
        ]);
    }

    public function showResult(Request $request, $date)
    {
        if ($request->has('form')) {
            foreach ($request->form as $form => $value) {
                $message = Result::find($value['id']);
                $message->message = $value['message'];
                $message->save();
                Session::flash('message', 'Комментарий обновлён');
            }
        }
        if ($request->has('delete')) {
            $message = Result::find($request->deleteIdMessage);
            $message->published = NULL;
            $message->save();
            Session::flash('message', 'Заметка улетела в черновик');
        }
        if ($request->has('edit-message')) {
            $message = Result::find($request->id);
            $message->message = $request->message;
            $message->save();
            Session::flash('message', 'Комментарий обновлён');

        }
        if ($request->has('boot')) {
            $test = User::find(Auth::id())->results()->where('date', $date)->get()->first();
            if ($test && $test->count()) {
                $test->message = $test->message . chr(13) . $request->addmessage;
                $test->save();
                Session::flash('message', 'Добавлены данные в вашу заметку');

            } else {
                $message = new Result;
                $message->message = $request->addmessage;
                $message->date = $date;
                $user = User::find(Auth::id());
                $user->results()->save($message);
                Session::flash('message', 'Добавлена новая запись');
            }
        }

        $allData = Result::all();
        $allDataToday = $allData->where('date', $date);
        //$messagesGroupBy = User::find(Auth::id())->results()->where('published', '=', NULL)->get()
        //            ->groupBy('date');
        /*$allDataMessage=Result::where('date',$date)
            ->where('published','=',1)
            ->get()->groupBy('date');*/
        //dump($allDataMessage);
        $id = Auth::id();
        //dump(User::find(Auth::id())->results()->where('date',$date)->delete());
        //dump(User::find(Auth::id())->results());

        return view('result.show', [
            'allUsers' => User::all(),
            'allData' => $allData,
            'allDataToday' => $allDataToday,
            'date' => $date,
            'id' => $id,
        ]);
    }

}
