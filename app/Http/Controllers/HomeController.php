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
            $ideas = Idea::withCount('comments')->orderBy('comments_count', 'desc')->get();
        }
        else{
            $ideas = Idea::where('deleted_at', null)->get();
        }
        return view('home', ['ideas' => $ideas]);

    }

    public function filByCategory($id)
    {
        if(request()->sort_by == 'popular'){
            $ideas = Idea::where('category_id', $id)->get()->sortByDesc('views');

        }
        else if(request()->sort_by == 'newtest'){
            $ideas = Idea::where('category_id', $id)->get()->sortByDesc('created_at');
        }
        else if(request()->sort_by == 'like'){
            dd(request()->sort_by);
        }
        else if(request()->sort_by == 'comments'){
            $ideas = Idea::where('category_id', $id)->withCount('comments')->orderBy('comments_count', 'desc')->get();
        }
        else{
            $ideas = Idea::where('category_id', $id)->get();
        }
        return view('home', ['ideas' => $ideas]);
    }

    public function dashboard(){
        $ideas = Idea::all();
        $categories = Category::withCount('ideas')->get();

        $contributors = Idea::select('user_id')->groupBy('category_id')->get();

        dd($contributors);

        $ideas_jan = Idea::whereMonth('created_at', '=', 1)->get();
        $ideas_feb = Idea::whereMonth('created_at', '=', 2)->get();
        $ideas_mar = Idea::whereMonth('created_at', '=', 3)->get();
        $ideas_apr = Idea::whereMonth('created_at', '=', 4)->get();
        $ideas_may = Idea::whereMonth('created_at', '=', 5)->get();
        $ideas_jun = Idea::whereMonth('created_at', '=', 6)->get();
        $ideas_jul = Idea::whereMonth('created_at', '=', 7)->get();
        $ideas_aug = Idea::whereMonth('created_at', '=', 8)->get();
        $ideas_sep = Idea::whereMonth('created_at', '=', 9)->get();
        $ideas_oct = Idea::whereMonth('created_at', '=', 10)->get();
        $ideas_nov = Idea::whereMonth('created_at', '=', 11)->get();
        $ideas_dec = Idea::whereMonth('created_at', '=', 12)->get();
        return view('dashboard', [
            'ideas' => $ideas,
            'ideas_jan' => $ideas_jan,
            'ideas_feb' => $ideas_feb,
            'ideas_mar' => $ideas_mar,
            'ideas_apr' => $ideas_apr,
            'ideas_may' => $ideas_may,
            'ideas_jun' => $ideas_jun,
            'ideas_jul' => $ideas_jul,
            'ideas_aug' => $ideas_aug,
            'ideas_sep' => $ideas_sep,
            'ideas_oct' => $ideas_oct,
            'ideas_nov' => $ideas_nov,
            'ideas_dec' => $ideas_dec,
            'categories' => $categories,
        ]);
    }
}
