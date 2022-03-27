<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Comment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        
        if(request()->sort_by == 'popular'){
            $ideas = Idea::all()->where('deleted_at', null)->sortByDesc('views');
            return view('home', ['ideas' => $ideas]);

        }
        else if(request()->sort_by == 'newtest'){
            $ideas = Idea::all()->where('deleted_at', null)->sortByDesc('created_at');
            return view('home', ['ideas' => $ideas]);
        }
        else if(request()->sort_by == 'like'){
            dd(request()->sort_by);
        }
        else if(request()->sort_by == 'comments'){
            $ideas = Idea::all()->where('deleted_at', null);
            dd($ideas);
            // $id = $ideas->id;
            dd($id);
            $comments = Comment::all()->where('account_id', $id);
            // dd(count($comments));
        }
        else{
            $ideas = Idea::all()->where('deleted_at', null);
            return view('home', ['ideas' => $ideas]);
        }
        
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
