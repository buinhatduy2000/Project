<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $ideas = Idea::all()->where('deleted_at', null);
        if (Auth::guard('account')->check() && Auth::guard('account')->user()->role == Account::ACCOUNT_ADMIN) {
            return view('admin.home');
        }
        return view('user.home', ['ideas' => $ideas]);
    }
}
