<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Idea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function login(Request $request)
    {
        return view('login');
    }

    public function postLogin(Request $request){
        if(Auth::guard('account')->attempt($request->only('user_name','password'))){
            return redirect()->route('home');
        }
            $request->session()->flash('check_email','Please check email and password');
            return redirect()->back()->withInput();
    }

    public function logout()
    {
        Auth::guard('account')->logout();
        return redirect()->route('login');
    }

    public function viewInfo ($id) {
        $account = Account::find($id);
        if(request()->sort_by == 'popular'){
            $ideas = Idea::where('user_id', $id)->get()->sortByDesc('views');
            return view('viewInfo', ['account' => $account, 'ideas' => $ideas]);

        }
        else if(request()->sort_by == 'newtest'){
            $ideas = Idea::where('user_id', $id)->get()->sortByDesc('created_at');
            return view('viewInfo', ['account' => $account, 'ideas' => $ideas]);
        }
        else if(request()->sort_by == 'like'){
            dd(request()->sort_by);
        }
        else if(request()->sort_by == 'comments'){
            dd(request()->sort_by);
        }
        else{
            $ideas = Idea::where('user_id', $id)->get();
            return view('viewInfo', ['account' => $account, 'ideas' => $ideas]);
        }
    }
}
