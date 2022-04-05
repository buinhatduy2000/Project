<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Idea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Validator;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(10)->sortByDesc('id');
        return view('category', compact('categories'))->with('i', (request()-> input('page', 1) -1)*10);
    }

    public function store(Request $request){
        $request->validate([
            'category_name' => 'required|max:255|unique:categories',
            'category_date' => 'required|date_format:Y-m-d|after_or_equal:'.date('Y-m-d')
        ]);
        $cate = Category::create([
            'category_name' => $request->category_name,
            'first_closure_date' => $request->category_date,
            'second_closure_date' => Carbon::createFromFormat('Y-m-d', $request->category_date)->addDays(14),
        ]);
        if(!$cate){
            return redirect()->back()->with('error','Create Category Not Success');
        }
        return redirect() -> route('category.index')->with('success', 'Create Category Success');

    }

    public function update(Request $request, $id){
        $cate = Category::find($id);
        if($cate){
            $request->validate([
                'category_name' => 'required',
//                'category_date' => 'required|date_format:Y-m-d|after_or_equal:'.date('Y-m-d')
            ]);
            $update_cate = $cate->update([
                'category_name' => $request->input('category_name'),
            ]);
            if (Auth::guard('account')->user()->role == Account::ACCOUNT_ADMIN){
                $request->validate([
                    'category_date' => 'required|date_format:Y-m-d|after_or_equal:'.date('Y-m-d')
                ]);
                $cate->update([
                    'first_closure_date' => $request->category_date,
                    'second_closure_date' => Carbon::createFromFormat('Y-m-d', $request->category_date)->addDays(14),
                ]);
            }
            if(!$update_cate){
                return redirect()->back()->with('error','Update Category Not Success');
            }
            return redirect() -> route('category.index')->with('success',  'Update Category Success');
        }
    }

    public function destroy(Request $request, $id){
//        if (! Gate::allows('delete-cate', $category)) {
//            return redirect()->back()->with('error','You can not delete category');
//        }
        $cate = Category::find($id);
        if ($cate->ideas->count() != 0){
            return redirect()->back()->with('error','Delete Category Not Success');
        }
        if($cate){
            $delete_cate = $cate->delete();

            if(!$delete_cate){
                return redirect()->back()->with('error','Delete Category Not Success');
            }
            return redirect() -> route('category.index')->with('success', 'Delete Category Success');
        }

    }
}
