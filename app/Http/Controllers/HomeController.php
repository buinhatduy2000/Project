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
        if (Auth::guard('account')->user()->role == Account::ACCOUNT_STAFF) {
            $department = Auth::guard('account')->user()->personal_info->department;
            $ideas = Idea::where('department', $department)->where('deleted_at', null);
            if(request()->sort_by == 'popular'){
                $ideas->withCount([
                    'likeDislikes as likes_count' => function ($query) {
                        $query->where('type', 1);
                    },
                    'likeDislikes as dislikes_count' => function ($query) {
                        $query->where('type', 0);
                    },
                ])->orderByRaw('likes_count - dislikes_count DESC');
            }
            else if(request()->sort_by == 'view'){
                $ideas->orderBy('views', 'desc');

            }
            else if(request()->sort_by == 'newest'){
                $ideas->orderBy('created_at', 'desc');
            }
            else if(request()->sort_by == 'comments'){
                $ideas->with('latestComment')
                        ->withCount([
                            'likeDislikes as likes_count' => function ($query) {
                                $query->where('type', 1);
                            },
                            'likeDislikes as dislikes_count' => function ($query) {
                                $query->where('type', 0);
                            }
                        ])->get()->sortByDesc('latestComment.created_at');

                return view('home', ['ideas' => $ideas->paginate(5)->appends(['sort_by' => request()->sort_by])]);

            }
            $ideas->withCount([
                'likeDislikes as likes_count' => function ($query) {
                    $query->where('type', 1);
                },
                'likeDislikes as dislikes_count' => function ($query) {
                    $query->where('type', 0);
                }
            ]);
        }
        else{
            $ideas = Idea::where('deleted_at', null);
            if(request()->sort_by == 'popular'){
                $ideas->withCount([
                    'likeDislikes as likes_count' => function ($query) {
                        $query->where('type', 1);
                    },
                    'likeDislikes as dislikes_count' => function ($query) {
                        $query->where('type', 0);
                    },
                ])->orderByRaw('likes_count - dislikes_count DESC');
            }
            else if(request()->sort_by == 'view'){
                $ideas->orderBy('views', 'desc');
            }
            else if(request()->sort_by == 'newest'){
                $ideas->orderBy('created_at', 'desc');
            }
            else if(request()->sort_by == 'comments'){
                $ideas->with('latestComment')
                        ->withCount([
                            'likeDislikes as likes_count' => function ($query) {
                                $query->where('type', 1);
                            },
                            'likeDislikes as dislikes_count' => function ($query) {
                                $query->where('type', 0);
                            }
                        ])->get()->sortByDesc('latestComment.created_at');
                return view('home', ['ideas' => $ideas->paginate(5)->appends(['sort_by' => request()->sort_by])]);
            }
            $ideas->withCount([
                'likeDislikes as likes_count' => function ($query) {
                    $query->where('type', 1);
                },
                'likeDislikes as dislikes_count' => function ($query) {
                    $query->where('type', 0);
                }
            ]);

        }
         return view('home', ['ideas' => $ideas->paginate(5)->appends(['sort_by' => request()->sort_by])]);
//        return view('home', ['ideas' => $ideas]);
    }

    public function filByCategory($id)
    {
        if (Auth::guard('account')->user()->role == Account::ACCOUNT_STAFF) {
            $department = Auth::guard('account')->user()->personal_info->department;
            $ideas = Idea::where('category_id', $id)->where('department', $department);
            if(request()->sort_by == 'popular'){
                $ideas->withCount([
                    'likeDislikes as likes_count' => function ($query) {
                        $query->where('type', 1);
                    },
                    'likeDislikes as dislikes_count' => function ($query) {
                        $query->where('type', 0);
                    },
                ])->orderByRaw('likes_count - dislikes_count DESC');
            }
            else if(request()->sort_by == 'view'){
                $ideas->orderBy('views', 'desc');
            }
            else if(request()->sort_by == 'newest'){
                $ideas->orderBy('created_at', 'desc');
            }
            else if(request()->sort_by == 'comments'){
                $ideas->with('latestComment')
                    ->withCount([
                        'likeDislikes as likes_count' => function ($query) {
                            $query->where('type', 1);
                        },
                        'likeDislikes as dislikes_count' => function ($query) {
                            $query->where('type', 0);
                        }
                    ])->get()->sortByDesc('latestComment.created_at');
                return view('home', ['ideas' => $ideas->paginate(5)->appends(['sort_by' => request()->sort_by])]);
            }
            $ideas->withCount([
                    'likeDislikes as likes_count' => function ($query) {
                        $query->where('type', 1);
                    },
                    'likeDislikes as dislikes_count' => function ($query) {
                        $query->where('type', 0);
                    }
            ]);
        }
        else{
            $ideas = Idea::where('category_id', $id)->where('deleted_at', null);
            if(request()->sort_by == 'popular'){
                $ideas->withCount([
                    'likeDislikes as likes_count' => function ($query) {
                        $query->where('type', 1);
                    },
                    'likeDislikes as dislikes_count' => function ($query) {
                        $query->where('type', 0);
                    },
                ])->orderByRaw('likes_count - dislikes_count DESC');
            }
            else if(request()->sort_by == 'view'){
                $ideas->orderBy('views', 'desc');
            }
            else if(request()->sort_by == 'newest'){
                $ideas->orderBy('created_at', 'desc');
            }
            else if(request()->sort_by == 'comments'){
                $ideas->with('latestComment')
                    ->withCount([
                        'likeDislikes as likes_count' => function ($query) {
                            $query->where('type', 1);
                        },
                        'likeDislikes as dislikes_count' => function ($query) {
                            $query->where('type', 0);
                        }
                    ])->get()->sortByDesc('latestComment.created_at');
                return view('home', ['ideas' => $ideas->paginate(5)->appends(['sort_by' => request()->sort_by])]);
            }
            $ideas->withCount([
                'likeDislikes as likes_count' => function ($query) {
                    $query->where('type', 1);
                },
                'likeDislikes as dislikes_count' => function ($query) {
                    $query->where('type', 0);
                }
            ]);
        }
         return view('home', ['ideas' => $ideas->paginate(5)->appends(['sort_by' => request()->sort_by])]);
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
