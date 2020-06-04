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
        if ($request->has('form')) {
            foreach ($request->form as $form => $value) {
                $message = Result::find($value['id']);
                $message->message = $value['message'];
                $message->save();
                Session::flash('message', 'Комментарий обновлён');
            }
        }
        if ($request->has('boot')) {
            $message = new Result;
            $message->message = $request->addmessage;
            $message->date = $request->date;
            $user = User::find(Auth::id());
            $user->results()->save($message);
            Session::flash('message', 'Добавлена новая запись');
        }
        if ($request->has('delete')) {
            User::find(Auth::id())->results()->find($request->deleteIdMessage)->delete();
            DB::table('result_user')->where([
                ['user_id', Auth::id()],
                ['result_id', $request->deleteIdMessage]
            ])->delete();
            Session::flash('message', 'Ваша заметка удалена');
        }
        if ($request->has('public')) {
            $message = Result::find($request->messageid);
            $message->published = 1;
            $message->save();
            Session::flash('message', 'Заметка опубликована');
        }

        $messagesGroupBy = User::find(Auth::id())->results()->where('published', '=', NULL)->get()
            ->groupBy('date');
        $messages = User::find(Auth::id())->results()->get();
        $results = DB::table('results')->select(DB::raw('date'))->
            orderBy('date','desc')->groupBy('date')->get();
        return view('lk.show', [
            'messages' => $messages,
            'results' => $results,
            'messagesGroupBy' => $messagesGroupBy
        ]);
    }
}
