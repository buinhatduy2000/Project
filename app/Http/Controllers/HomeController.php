<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Comment;
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
        if(request()->sort_by == 'popular'){
            $ideas = Idea::all()->where('deleted_at', null)->sortByDesc('views');

        }
        else if(request()->sort_by == 'newtest'){
            $ideas = Idea::all()->where('deleted_at', null)->sortByDesc('created_at');
        }
        else if(request()->sort_by == 'like'){
            dd(request()->sort_by);
        }
        else if(request()->sort_by == 'comments'){
            $ideas = Idea::all()->where('deleted_at', null)->sortByDesc('comments');
        }
        else{
            $ideas = Idea::all()->where('deleted_at', null);
        }
        return view('user.home', ['ideas' => $ideas]);


    }

    public function filByCategory($id)
    {
        if(request()->sort_by == 'popular'){
            $ideas = Idea::where('category_id', $id)->get()->sortByDesc('views');
            return view('home', ['ideas' => $ideas]);

        }
        else if(request()->sort_by == 'newtest'){
            $ideas = Idea::where('category_id', $id)->get()->sortByDesc('created_at');
            return view('home', ['ideas' => $ideas]);
        }
        else if(request()->sort_by == 'like'){
            dd(request()->sort_by);
        }
        else if(request()->sort_by == 'comments'){
            dd(request()->sort_by);
        }
        else{
            $ideas = Idea::where('category_id', $id)->get();
            return view('home', ['ideas' => $ideas]);
        }
    }
}
