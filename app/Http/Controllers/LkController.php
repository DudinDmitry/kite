<?php

namespace App\Http\Controllers;

use App\Result;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //dump($request->form);
        if ($request->has('form')) {

            foreach ($request->form as $form => $value) {
                //dump($value);
                $message = Result::find($value['id']);
                $message->message = $value['message'];
                $message->save();
                Session::flash('message', 'Комментарий обновлён');
            }


        }
        $messages = User::find(Auth::id())->results()->get();
        //dump(DB::table('results')->select(DB::raw('date'))->groupBy('date')->get());
        return view('lk.show', [
            'messages' => $messages
        ]);
    }
}
