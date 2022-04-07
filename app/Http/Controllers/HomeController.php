<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        if(request()->sort_by == 'popular'){
            $ideas = Idea::where('deleted_at', null)->sortByDesc('views');
        }
        else if(request()->sort_by == 'newtest'){
            $ideas = Idea::where('deleted_at', null)->sortByDesc('created_at');
        }
        else if(request()->sort_by == 'like'){
            dd(request()->sort_by);
        }
        else if(request()->sort_by == 'comments'){
            $ideas = Idea::withCount('comments')->orderBy('comments_count', 'desc');
        }
        else{
            $ideas = Idea::where('deleted_at', null);
        }
        if (Auth::guard('account')->user()->role == Account::ACCOUNT_STAFF) {
            $ideas = $ideas->where('department', Auth::guard('account')->user()->personal_info->department);
        }
        return view('home', ['ideas' => $ideas->paginate(5)]);

    }

    public function filByCategory($id)
    {
        if(request()->sort_by == 'popular'){
            $ideas = Idea::where('category_id', $id)->sortByDesc('views');
        }
        else if(request()->sort_by == 'newtest'){
            $ideas = Idea::where('category_id', $id)->sortByDesc('created_at');
        }
        else if(request()->sort_by == 'like'){
            dd(request()->sort_by);
        }
        else if(request()->sort_by == 'comments'){
            $ideas = Idea::where('category_id', $id)->withCount('comments')->orderBy('comments_count', 'desc');
        }
        else{
            $ideas = Idea::where('category_id', $id)->where('deleted_at', null);
        }
        if (Auth::guard('account')->user()->role == Account::ACCOUNT_STAFF) {
            $ideas = $ideas->where('department', Auth::guard('account')->user()->personal_info->department);
        }
        return view('home', ['ideas' => $ideas->paginate(5)]);
    }

    public function dashboard(){
        $ideas = Idea::all();
        $categories = Category::withCount('ideas')->get();

        $contributors = Idea::select('user_id')->groupBy('category_id')->get();

        $month = ['1','2','3','4','5','6', '7', '8', '9', '10', '11', '12'];
        $idea_monthly = array();
        foreach($month as $key => $value){
            $idea_month = Idea::select(
                DB::raw("(COUNT(*)) as count"),
                DB::raw("MONTH(created_at) as month_number")
            )->whereYear('created_at', date('Y'))
             ->whereMonth('created_at', $key+1)
             ->get();
            foreach ($idea_month as $item){
                $idea_monthly[] = $item['count'] ?? 0;
            }
        }
        return view('dashboard', [
            'ideas' => $ideas,
            'categories' => $categories,
            'idea_monthly' => $idea_monthly,
        ]);
    }
}
