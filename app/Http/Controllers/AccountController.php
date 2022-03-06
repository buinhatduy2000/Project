<?php

namespace App\Http\Controllers;

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
            return redirect()->route('home')->with('success','Đăng nhập thành công');
        }else{
            return redirect()->back()->with('error','Tên đăng nhập hoặc mật khẩu không đúng');
        }
    }

    public function logout()
    {
        Auth::guard('account')->logout();
        return redirect()->route('login');
    }
}
