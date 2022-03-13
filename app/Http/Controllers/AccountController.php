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
        $ideas = Idea::where('user_id', $id)->get();
        return view('viewInfo', ['account' => $account, 'ideas' => $ideas]);
    }
}
